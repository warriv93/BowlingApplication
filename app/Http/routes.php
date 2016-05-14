<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', array(
    'uses' => 'scoreController@initiate'
));

Route::get('/get', array(
    'uses' => 'scoreController@resetStats'
));

// Route::delete('/score/{id}', array(
//     'uses' => 'scoreController@clearTable'
// ));

 //Uses "BowlingController" with "postStats" method
Route::post('/post', 'scoreController@postStats');
