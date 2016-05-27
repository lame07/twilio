<?php

class TwilioController extends BaseController
{

    public function respond()
    {
        $phoneCall               = new \app\models\PhoneCall();
        $phoneCall->phone_number = Input::get('phone_number');
        $phoneCall->save();

        $response = app(\Services_Twilio_Twiml::class);
        $response->say('Calling, wait a minute');
        $response->dial(getenv('TWILIO_API_NUMBER'));

        return Response::make($response, '200')->header('Content-Type', 'text/xml');
    }

}
