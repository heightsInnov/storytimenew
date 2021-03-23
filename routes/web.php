<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Helpers\AdminSeeder;

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

Route::get('/', function () {
    return view('welcome');
});

/** Cache */
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

/** SEED DB */
Route::get('/seed-db', function() {
    AdminSeeder::admin();
    return "Database seeded successfully";
});

// REGISTER USERS
Route::post('users/create',         'App\Http\Controllers\Auth\RegisterController@register')->name('register');

//GUESTS ONLY
Route::group(['namespace' => 'App\Http\Controllers\Auth', 'middleware' => 'guest'],function () {

    Route::get('login', 'LoginController@login')->name('login');
    Route::post('user/register',       'LoginController@register')->name('register_user');
    Route::post('user/login',       'LoginController@loginUser')->name('user_login');
    Route::post('recover',          'ForgotPasswordController@recover')->name('recover_password');
    Route::post('reset/{token}',    'ResetPasswordController@reset')->name('reset_password');
    // Route::post('create/password/{token}', 'ForgotPasswordController@createPassword')->name('create_password');

    //VERIFY USER
    Route::get('user/verify/{id}/{code}', 'LoginController@verifyUser')->name('verify_user');
    Route::patch('user/verify2/{id}/{code}',      'LoginController@verifyUser2')->name('verify_user2');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//AUTHENTICATION ROUTE

//ADMIN
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard',         'AdminController@index')->name('dashboard');
    Route::get('users',             'AdminController@listUsers')->name('users');
    Route::get('users/create',      'AdminController@create')->name('users.create');
    Route::post('users',            'AdminController@store')->name('users.store');
    Route::get('users/{id}',        'AdminController@show')->name('users.show');
    Route::get('users/{id}/edit',   'AdminController@edit')->name('users.edit');
    Route::patch('users/{id}',      'AdminController@update')->name('users.update');
    Route::delete('users/{id}',     'AdminController@delete')->name('users.destroy');
    Route::get('user/logout',      'AdminController@logout')->name('admin_logout');
    Route::post('user/me',          'AdminController@me')->name('me');

    //PASSWORD
    Route::post('change/password',  'AdminController@changePassword')->name('admin_change_password');

});

// Logged Users Only

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'],function () {

    //STORY SEEKER
    Route::get('seeker_dashboard',       'StorySeekerController@seekerDashboard')->name('seeker_dashboard');
    Route::get('seeker_view_story/{id}',       'StorySeekerController@fetchStory')->name('seek_a_story');
    Route::get('seeker_view_all_story',      'StorySeekerController@allStory')->name('seek_all_stories');
    Route::get('seeker_profile/{id}',      'StorySeekerController@seeProfile')->name('see_seeker_profile');
    Route::patch('update_seeker_profile/{id}',      'StorySeekerController@updateProfile')->name('update_seeker_profile');
    Route::get('seeker/logout',      'StorySeekerController@logout')->name('story_seeker__logout');

    //PASSWORD
    Route::post('seeker/change/password',  'StorySeekerController@changePassword')->name('story_seeker_change_password');

    //STORY TELLER
    Route::get('teller_dashboard',       'StoryTellerController@tellerDashboard')->name('teller_dashboard');
    Route::post('teller_send_story',       'StoryTellerController@sendStory')->name('tell_story');
    Route::get('teller_profile/{id}',      'StoryTellerController@seeProfile')->name('see_teller_profile');
    Route::patch('update_teller_profile/{id}',      'StoryTellerController@updateProfile')->name('update_teller_profile');
    Route::get('teller/logout',      'StoryTellerController@logout')->name('story_teller_logout');

    //PASSWORD
    Route::post('teller/change/password',  'StoryTellerController@changePassword')->name('story_teller_change_password');
});
