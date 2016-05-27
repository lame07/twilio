<?php

Route::get('/', ['as' => 'indexPage', 'uses' => 'HomeController@showIndex']);
Route::get('/callPage', ['as' => 'callPage', 'uses' => 'HomeController@showCallPage']);
Route::get('/twilioRespond', ['as' => 'twilioRespond', 'uses' => 'TwilioController@respond']);
