<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// API Endpoints
Route::get('/questions', 'QuestionAndScoringController@get_public');
Route::get('/results/type/{type}/{high_score_type}', 'ResultsController@get');
Route::get('/token/search/{title}', 'TokenController@search');
Route::post('/charge', 'ChargeController@charge');
Route::post('/token/redeem', 'TokenController@redeem');

// User Auth Routes
Auth::routes(['register' => false]);

// Admin Routes
Route::get('/admin', 'Admin\DashboardController@index')->middleware('auth');
Route::post('/admin/create-access-code', 'Admin\DashboardController@create_access_code')->name('create_access_code')->middleware('auth');
Route::post('/admin/change-password', 'Admin\DashboardController@change_password')->name('change_password')->middleware('auth');

// Renders the results email in the browser for design review (admin only).
Route::get('/admin/email-preview', function () {
    return new \App\Mail\AssessmentResults(
        'Ryan',
        '1',
        url('/type1?t1=80&t2=40&t3=55&t4=30&t5=60&t6=45&t7=50&t8=35&t9=42')
    );
})->middleware('auth');

// Renders the purchase-confirmation email in the browser (admin only).
Route::get('/admin/email-preview-purchase', function () {
    return view('emails.purchase', [
        'firstName'  => 'Riley',
        'accessCode' => '6QOsj0X9pLpO6DJZ',
        'uses'       => 1,
        'orderTotal' => 24,
    ]);
})->middleware('auth');

// Renders the owner-notification email in the browser (admin only).
Route::get('/admin/email-preview-owner', function () {
    return view('emails.results-owner', [
        'takerName'       => 'Jane Smith',
        'takerEmail'      => 'jane@example.com',
        'accessCode'      => 'submittest',
        'enneagramNumber' => '1',
        'resultsUrl'      => url('/type1?t1=100&t2=26&t3=26&t4=26&t5=26&t6=26&t7=26&t8=26&t9=26'),
    ]);
})->middleware('auth');

// Renders the access-code email (sent when an admin creates a code with an
// owner email) in the browser (admin only).
Route::get('/admin/email-preview-access-code', function () {
    return view('emails.access-code', [
        'accessCode' => 'SAMPLE123',
        'uses'       => 5,
    ]);
})->middleware('auth');

// Application Routes
Route::post('/submit', 'SubmissionController@index');
Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
Route::post('/token/{id}', 'TokenController@update');
