<?php

class TwilioController extends BaseController
{

	public function respond()
	{
		$response = new Services_Twilio_Twiml();
		$response->say('Calling, wait a minute');
		$response->dial(getenv('TWILIO_API_NUMBER'));

		print $response;
	}

}
