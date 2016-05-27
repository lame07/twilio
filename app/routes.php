<?php

Route::get('/', ['as' => 'indexPage', 'uses' => 'HomeController@showIndex']);
Route::get('/callPage', ['as' => 'callPage', 'uses' => 'HomeController@showCallPage']);
Route::get('/twilioRespond', 'TwilioController@respond');
