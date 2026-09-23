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

// Renders the results email in the browser for design review (admin only).
Route::get('/admin/email-preview', function () {
    return new \App\Mail\AssessmentResults(
        'Ryan',
        '1',
        url('/type1?t1=80&t2=40&t3=55&t4=30&t5=60&t6=45&t7=50&t8=35&t9=42')
    );
})->middleware('auth');

// Application Routes
Route::post('/submit', 'SubmissionController@index');
Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');
Route::post('/token/{id}', 'TokenController@update');
