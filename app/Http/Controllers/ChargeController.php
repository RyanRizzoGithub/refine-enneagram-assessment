<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Token;

class ChargeController extends Controller
{
    public function charge(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|string|min:2',
            'last_name' => 'bail|required|string|min:2',
            'email' => 'bail|required|email',
            'title' => 'sometimes|bail|required|string|min:2|max:16',
            'uses'  => 'sometimes|bail|required|integer|min:1|max:1000',
            'token' => 'bail|required|string',
        ],
        [
            'title.min' => 'The access code must be at least 2 characters.',
            'title.max' => 'The access code may not be greater than 16 characters.',
        ]);

        if ($validator->fails()) {
            $validator->validate();
        } else {

            \Stripe\Stripe::setApiKey(env('STRIPE_LIVE') ? env('STRIPE_SECRET_LIVE') : env('STRIPE_SECRET'));
            $err = '';

            try {
                $stripe_intent = \Stripe\PaymentIntent::create([
                    'amount'   => env('STRIPE_CHARGE_AMOUNT') * ($request->uses ? $request->uses : 1),
                    'currency' => 'USD',
                    'confirm'  => true,
                    'payment_method' => $request->token,
                    'metadata' => [
                        'Email' => $request->email,
                        'Name' => "$request->first_name $request->last_name",
                        'Access Code' => $request->title,
                        'Access Code Uses Purchased' => $request->uses ? $request->uses : 1,
                        'Purchase Source' => env('APP_NAME'),
                    ],
                    'statement_descriptor' => env('APP_NAME') .' Code',
                ]);
            } catch (\Stripe\Exception\CardException $e) {
                // Card was declined.
                $err = optional($e->getError())->message ?: $e->getMessage();
            } catch (\Stripe\Exception\ApiErrorException $e) {
                // Any other Stripe API error (invalid request, authentication,
                // connection, rate limit, ...). NOTE: the old code caught Stripe
                // SDK v1 class names (Stripe_CardError, etc.) that don't exist in
                // v7, so every Stripe error fell through uncaught as a 500.
                $err = optional($e->getError())->message ?: $e->getMessage();
            } catch (\Throwable $e) {
                // Anything unrelated to Stripe.
                Log::error('Non-Stripe charge error: ' . $e->getMessage());
                $err = 'Something went wrong processing your payment. Please try again.';
            }

            if ($err) {
                Log::warning('Stripe charge failed: ' . $err);
                $response = array('success' => false, 'message' => $err);
            } else {
                // Success

                if (is_null($request->title)) {
                    // Single use access code
                    $new_access_token = TokenController::store($request);
                    $response = array('success' => true, 'access_token' => $new_access_token);

                    // update payment intent with the access code that was generated (best-effort)
                    try {
                        \Stripe\PaymentIntent::update($stripe_intent->id, ['metadata' => ['Access Code' => $response['access_token']]]);
                    } catch (\Throwable $e) {
                        Log::warning('PaymentIntent metadata update failed: ' . $e->getMessage());
                    }

                } else {
                    // Multi use access code
                    $access_token = Token::where('title', $request->title)->first();
                    if (is_null($access_token)) {
                        $new_access_token = TokenController::store($request);
                        $response = array('success' => true, 'access_token' => $new_access_token);
                    } else {
                        $access_token->increment('uses', $request->uses);
                        $response = array('success' => true, 'access_token' => $access_token->title);
                    }
                }

                // Send the purchase-confirmation email directly via Resend's
                // HTTP API (best-effort), the same as the results email.
                try {
                    $html = view('emails.purchase', [
                        'firstName'  => $request->first_name,
                        'accessCode' => $response['access_token'],
                        'uses'       => $request->uses ? $request->uses : 1,
                        'orderTotal' => $stripe_intent->amount / 100,
                    ])->render();

                    $payload = json_encode([
                        'from'    => env('MAIL_FROM_NAME', 'theREFINEnetwork') . ' <' . env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev') . '>',
                        'to'      => [$request->email],
                        'subject' => 'Your Enneagram assessment access code',
                        'html'    => $html,
                    ]);

                    $ch = curl_init('https://api.resend.com/emails');
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => $payload,
                        CURLOPT_HTTPHEADER     => [
                            'Authorization: Bearer ' . env('RESEND_API_KEY'),
                            'Content-Type: application/json',
                        ],
                        CURLOPT_CONNECTTIMEOUT => 5,
                        CURLOPT_TIMEOUT        => 10,
                    ]);
                    $resp    = curl_exec($ch);
                    $code    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $curlErr = curl_error($ch);
                    curl_close($ch);

                    if ($resp === false || $code < 200 || $code >= 300) {
                        Log::warning("Resend purchase email failed (HTTP $code): " . ($curlErr ?: $resp));
                    }
                } catch (\Throwable $e) {
                    Log::warning('Purchase email send failed: ' . $e->getMessage());
                }
            }

            return response()->json($response, 200);
        }
    }
}
