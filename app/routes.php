<?php

Route::get('/', 'HomeController@showIndex');
Route::get('/twilioRespond', 'TwilioController@respond');
