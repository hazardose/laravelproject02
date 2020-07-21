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
// comment this area for route:cache

// Route::get('/', function () {
//     return view('welcome');
// });
/// --- end here comment
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//add by shandy starts here: 
#location->(App\Http\Controllers :: QuestionsController.php)
Route::resource('questions', 'QuestionsController');
//end here