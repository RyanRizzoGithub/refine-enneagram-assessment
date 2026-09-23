<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class CrmController extends Controller
{
    public static function index($request, $category_score, $results_query) {

        $list_id = env('ACTIVECAMPAIGN_LIST_ID');
        $contact = array(
            "email" => $request->email,
            "first_name" => trim($request->first_name),
            "last_name" => trim($request->last_name),
            "p[{$list_id}]" => $list_id,
            "status[{$list_id}]" => 1, // "Active" status
        );

        $category_score_sorted = array_keys($category_score,max($category_score));

        $contact['field'] = array(
            '%YOUR_ENNEAGRAM_NUMBER%,0' => str_replace('type', '', $category_score_sorted[0]),
            '%RESULTS_URL%,0' => url($results_query),
            '%ACCESS_CODE_USED%,0' => $request->title,
            '%TYPE_1_SCORE%,0' => $category_score['type1'],
            '%TYPE_2_SCORE%,0' => $category_score['type2'],
            '%TYPE_3_SCORE%,0' => $category_score['type3'],
            '%TYPE_4_SCORE%,0' => $category_score['type4'],
            '%TYPE_5_SCORE%,0' => $category_score['type5'],
            '%TYPE_6_SCORE%,0' => $category_score['type6'],
            '%TYPE_7_SCORE%,0' => $category_score['type7'],
            '%TYPE_8_SCORE%,0' => $category_score['type8'],
            '%TYPE_9_SCORE%,0' => $category_score['type9'],
        );

        $contact['tags'] = array(
            "302" => env('APP_NAME') ." - Completed Assessment",
        );

        // ActiveCampaign sync is best-effort: a CRM/email failure (e.g. the
        // account being past-due/suspended, or a network error) must never
        // break a completed assessment. Log it and let the submission succeed.
        try {
            app('ActiveCampaign')->api("contact/sync", $contact);
        } catch (\Throwable $e) {
            Log::warning('ActiveCampaign contact sync failed on assessment submit: ' . $e->getMessage());
        }
    }
}
