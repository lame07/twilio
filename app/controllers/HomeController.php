<?php

class HomeController extends BaseController
{

    public function showIndex()
    {
        return View::make('index');
    }

    public function showCallPage()
    {
        $phoneNumber  = false;
        $errorMessage = false;

        if (Input::has('country')) {
            $twilioClient = new \Services_Twilio(getenv('TWILIO_API_SID'), getenv('TWILIO_API_TOKEN'));

            $numberProvider = new \app\models\PhoneNumberProvider($twilioClient, Input::get('country'));

            try {
                $phoneNumber = $numberProvider->getPhoneNumber()->phone_number;
            } catch (\Services_Twilio_RestException $e) {
                $errorMessage = $e->getMessage();
            }
        } else {
            return Redirect::route('indexPage');
        }

        return View::make('call_page')->with('phoneNumber', $phoneNumber)->with('errorMessage', $errorMessage);
    }

}
