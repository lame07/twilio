<?php

class HomeController extends BaseController
{

    public function showIndex()
    {
        $phoneNumber  = false;
        $errorMessage = false;

        if (Input::has('country')) {
            $twilioClient = new Services_Twilio(getenv('TWILIO_API_SID'), getenv('TWILIO_API_TOKEN'));

            $numberProvider = new \models\PhoneNumberProvider($twilioClient, Input::get('country'));

            try {
                $phoneNumber = $numberProvider->getPhoneNumber()->phone_number;
            } catch (Services_Twilio_RestException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        return View::make('index')->with('phoneNumber', $phoneNumber)->with('errorMessage', $errorMessage);
    }

}
