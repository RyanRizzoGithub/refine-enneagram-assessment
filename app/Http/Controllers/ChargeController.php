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
            } catch(Stripe_CardError $e) {
                // Since it's a decline, Stripe_CardError will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
            } catch (Stripe_InvalidRequestError $e) {
                // Invalid parameters were supplied to Stripe's API
                $body = $e->getJsonBody();
                $err  = $body['error'];
            } catch (Stripe_AuthenticationError $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                $body = $e->getJsonBody();
                $err  = $body['error'];
            } catch (Stripe_ApiConnectionError $e) {
                // Network communication with Stripe failed
                $body = $e->getJsonBody();
                $err  = $body['error'];
            } catch (Stripe_Error $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $body = $e->getJsonBody();
                $err  = $body['error'];
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $body = $e->getJsonBody();
                $err  = $body['error'];
            }

            if($err) {
                $response = array('success' => false, 'message' => $err);
            } else {
                // Success

                $list_id = env('ACTIVECAMPAIGN_LIST_ID');
                $contact = array(
                    "email" => $request->email,
                    "first_name" => trim($request->first_name),
                    "last_name" => trim($request->last_name),
                    "p[{$list_id}]" => $list_id,
                    "status[{$list_id}]" => 1, // "Active" status
                );


                if (is_null($request->title)) {
                    // Single use access code
                    $new_access_token = TokenController::store($request);
                    $response = array('success' => true, 'access_token' => $new_access_token);

                    $contact['tags'] = array(
                        "300" => env('APP_NAME') ." - Purchased Single-Use Access Code",
                    );

                    // update payment intent with the access code that was generated
                    \Stripe\PaymentIntent::update($stripe_intent->id, ['metadata' => ['Access Code' => $response['access_token']]]);

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

                    $contact['tags'] = array(
                        "301" => env('APP_NAME'). " - Purchased Multi-Use Access Code",
                    );
                }

                $contact['field'] = array(
                    '%STRIPE_PAYMENT_ID%,0' => $stripe_intent->id,
                    '%STRIPE_CHARGE_AMOUNT%,0' => $stripe_intent->amount / 100,
                    '%ACCESS_CODE_PURCHASED%,0' => $response['access_token'],
                    '%ACCESS_CODE_USES_PURCHASED%,0' => $request->uses ? $request->uses : 1,
                );

                // ActiveCampaign sync is best-effort and runs AFTER the card
                // has already been charged and the access code created, so a
                // CRM/email failure (e.g. the account past-due, or a network
                // error) must never turn a successful purchase into a 500.
                // Log it and return the successful response.
                try {
                    app('ActiveCampaign')->api("contact/sync", $contact);
                } catch (\Throwable $e) {
                    Log::warning('ActiveCampaign contact sync failed on purchase: ' . $e->getMessage());
                }
            }

            return response()->json($response, 200);
        }
    }
}
