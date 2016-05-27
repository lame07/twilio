<?php

class HomeController extends BaseController
{

    public function showIndex()
    {
        return View::make('index');
    }

    public function showCallPage()
    {
        if (!Input::has('country')) {
            return Redirect::route('indexPage');
        }

        $errorMessage = false;
        $phoneNumber  = false;

        try {
            $phoneNumberProvider = new \app\providers\PhoneNumberProvider(Input::get('country'));
            $phoneNumberModel    = $phoneNumberProvider->getPhoneNumber();
            $phoneNumber         = $phoneNumberModel->phone_number;
        } catch (\Services_Twilio_RestException $e) {
            $errorMessage = $e->getMessage();
        }

        return View::make('call_page')->with('phoneNumber', $phoneNumber)->with('errorMessage', $errorMessage);
    }

}
