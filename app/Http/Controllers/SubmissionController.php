<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CrmController;
use Illuminate\Validation\Rule;
use App\Token;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $validator = Validator::make($request->all(), [
                'first_name'  => 'bail|required|string|min:2',
                'last_name'  => 'bail|required|string|min:2',
                'email' => 'bail|required|email',
                'title' => [
                    'bail',
                    'required',
                    'string',
                    'exists:tokens',
                    Rule::exists('tokens')->where(function ($query) {
                        $query->where('uses', '>', 0);
                    }),
                ],

                // Question user responses by id
                "q1" =>  "bail|required|numeric",  // Rules exist for a reason and it frustrates me when people don't follow them.
                "q2" =>  "bail|required|numeric",  // I have any extremely loud inner critic.
                "q3" =>  "bail|required|numeric",  // I hold myself to a high standard and expect others to do the same.
                "q4" =>  "bail|required|numeric",  // There's a right way and a wrong way to do things.
                "q5" =>  "bail|required|numeric",  // Rules are suggestions. I like finding new ways to do things.
                "q6" =>  "bail|required|numeric",  // I can easily identify flaws.
                "q7" =>  "bail|required|numeric",  // I become more playful and relaxed with those closest to me.
                "q8" =>  "bail|required|numeric",  // Giving to and serving others is my main focus.
                "q9" =>  "bail|required|numeric",  // When I do something for someone I expect appreciation.
                "q10" =>  "bail|required|numeric", // I can typically tell when others need my help.
                "q11" =>  "bail|required|numeric", // I enjoy creating a welcoming environment.
                "q12" =>  "bail|required|numeric", // Giving to others is not as important as being successful.
                "q13" =>  "bail|required|numeric", // Those who know me well might say I am \"needy.\"
                "q14" =>  "bail|required|numeric", // The appearance of success is important to me.
                "q15" =>  "bail|required|numeric", // I'm easily able to blend in with various groups of people.
                "q16" =>  "bail|required|numeric", // I find my value in my accomplishments.
                "q17" =>  "bail|required|numeric", // I don't mind sharing my failures.
                "q18" =>  "bail|required|numeric", // Winning is most important.
                "q19" =>  "bail|required|numeric", // Only those closest to me hear about my doubts and frustrations.
                "q20" =>  "bail|required|numeric", // It is important to stand out from the crowd with a unique and special approach.
                "q21" =>  "bail|required|numeric", // I don't like being told to move on when dealing with my emotions.
                "q22" =>  "bail|required|numeric", // Being compared to others is extremely annoying.
                "q23" =>  "bail|required|numeric", // I handle criticism very well.
                "q24" =>  "bail|required|numeric", // I become more critical of myself and others when speaking to close friends.
                "q25" =>  "bail|required|numeric", // I want to blend in, I don't like to be seen as standing out.
                "q26" =>  "bail|required|numeric", // It's important that we have all the information before we move into action.
                "q27" =>  "bail|required|numeric", // I am slow to give my opinion but quick to ask questions.
                "q28" =>  "bail|required|numeric", // It frustrates me when people are not organized.
                "q29" =>  "bail|required|numeric", // I enjoy random visits from friends or co-workers.
                "q30" =>  "bail|required|numeric", // If I am comfortable around you I don't mind arguing and interjecting my opinion.
                "q31" =>  "bail|required|numeric", // It's important to me to ensure we plan for all possible scenarios.
                "q32" =>  "bail|required|numeric", // Sometimes my anxiety keeps me from taking action.
                "q33" =>  "bail|required|numeric", // I do my best work when I have clear guidance and instructions.
                "q34" =>  "bail|required|numeric", // I trust my instincts and quickly move into action.
                "q35" =>  "bail|required|numeric", // Those closest to me would say I am passive-aggressive.
                "q36" =>  "bail|required|numeric", // When I am stressed I like to stay busy to avoid anxiety.
                "q37" =>  "bail|required|numeric", // I don't want to miss out on an opportunity to celebrate.
                "q38" =>  "bail|required|numeric", // I would rather build something than maintain a system.
                "q39" =>  "bail|required|numeric", // I would hate to be trapped in the same position for a prolonged period of time.
                "q40" =>  "bail|required|numeric", // I don't enjoy social gatherings.
                "q41" =>  "bail|required|numeric", // I am typically optimistic but I am comfortable sharing my pessimistic views if I trust someone.
                "q42" =>  "bail|required|numeric", // People in my business/life would say I am aggressive.
                "q43" =>  "bail|required|numeric", // Making big decisions is easy to me.
                "q44" =>  "bail|required|numeric", // If someone doesn't step in to lead, I will.
                "q45" =>  "bail|required|numeric", // When I see someone being overlooked or bullied I spring into action.
                "q46" =>  "bail|required|numeric", // I am quick to give my opinion but slow to ask questions.
                "q47" =>  "bail|required|numeric", // It is easy to share my weaknesses.
                "q48" =>  "bail|required|numeric", // I tend to overstep relational bounds with those I am closest to.
                "q49" =>  "bail|required|numeric", // When in a meeting it is easy for me to withdraw from the conversation.
                "q50" =>  "bail|required|numeric", // Conflict of any kind makes me very uncomfortable.
                "q51" =>  "bail|required|numeric", // When having a conversation I find it easy to empathize and connect with others.
                "q52" =>  "bail|required|numeric", // People are comfortable confiding in me.
                "q53" =>  "bail|required|numeric", // I am quick to insert my opinion.
                "q54" =>  "bail|required|numeric", // I'm not generally needy but like to be affirmed by those closest to me.
            ],
            [
                'title.exists' => 'Sorry, that is not a valid access code.',
            ]);

            if($validator->fails()) {
                $validator->validate();
            } else {

                // Success

                $access_token = Token::where('title', $request->title)->first();
                $questions = QuestionAndScoringController::get_all();

                $category_score = [];
                $category_num_of_answers = [];
                $category_num_of_questions = [];
                $high_score = [];

                foreach ($questions as $question) {
                    if (array_key_exists('category', $question)) {

                        // category_score
                        if (array_key_exists($question["category"], $category_score)) {
                            $category_score[$question["category"]] += $request["q" . $question["id"]];
                        } else {
                            $category_score[$question["category"]] = $request["q" . $question["id"]];
                        }

                        // category_num_of_answers
                        if (array_key_exists($question["category"], $category_num_of_answers)) {
                            $category_num_of_answers[$question["category"]] += count($question["answers"]);
                        } else {
                            $category_num_of_answers[$question["category"]] = count($question["answers"]);
                        }

                        // category_num_of_questions
                        if (array_key_exists($question["category"], $category_num_of_questions)) {
                            $category_num_of_questions[$question["category"]] += 1;
                        } else {
                            $category_num_of_questions[$question["category"]] = 1;
                        }

                        // high_score
                        if (array_key_exists($question["category"], $high_score)) {
                            $high_score_val = collect($question["answers"])->sortByDesc('value')->first()['value'];
                            $high_score[$question["category"]] += $high_score_val;
                        } else {
                            $high_score_val = collect($question["answers"])->sortByDesc('value')->first()['value'];
                            $high_score[$question["category"]] = $high_score_val;
                        }
                    }
                }

                $results_query = "";
                $index = 1;
                $overall_score = 0;

                // NOTE: Current score range is 1 - 100

                foreach ($category_score as $category => $score) {

                    $current_range = $high_score[$category] - $category_num_of_questions[$category];
                    $new_range = (100 - 1);
                    $category_score[$category] = round(((($score - $category_num_of_questions[$category]) * $new_range) / $current_range) + 1, 0);
                    $results_query .= "t$index=$category_score[$category]&";
                    $index++;
                }

                $category_score_sorted = array_keys($category_score,max($category_score));
                $results_query = "/$category_score_sorted[0]?$results_query";
                $results_query = substr($results_query, 0, -1);

                $access_token->decrement('uses', 1);
                CrmController::index($request, $category_score, $results_query);

                // Send the results email directly from the app via Resend's HTTP
                // API (best-effort). We use HTTPS rather than SMTP because hosts
                // often block outbound SMTP ports; a short timeout + try/catch
                // keep a mail hiccup from ever slowing or breaking the submit.
                try {
                    $enneagram_number = str_replace('type', '', $category_score_sorted[0]);
                    $html = view('emails.results', [
                        'firstName'       => $request->first_name,
                        'enneagramNumber' => $enneagram_number,
                        'resultsUrl'      => url($results_query),
                    ])->render();

                    $payload = json_encode([
                        'from'    => env('MAIL_FROM_NAME', 'theREFINEnetwork') . ' <' . env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev') . '>',
                        'to'      => [$request->email],
                        'subject' => 'Here are your results',
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
                    $resp = curl_exec($ch);
                    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $err  = curl_error($ch);
                    curl_close($ch);

                    if ($resp === false || $code < 200 || $code >= 300) {
                        Log::warning("Resend results email failed (HTTP $code): " . ($err ?: $resp));
                    }
                } catch (\Throwable $e) {
                    Log::warning('Results email send failed on assessment submit: ' . $e->getMessage());
                }

            }
            $response = array('success' => true, 'resultsUrl' => $results_query);
            return response()->json($response, 200);
        }
    }
}
