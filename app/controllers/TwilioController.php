<?php

class TwilioController extends BaseController
{

	public function respond()
	{
		$phoneCall				 = new \models\PhoneCall();
		$phoneCall->phone_number = Input::get('phone_number');
		$phoneCall->save();

		$response = new Services_Twilio_Twiml();
		$response->say('Calling, wait a minute');
		$response->dial(getenv('TWILIO_API_NUMBER'));

		print $response;
	}

}
