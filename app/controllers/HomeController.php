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

        $countryCode      = strtoupper(Input::get('country'));
        $phoneNumberModel = \app\models\PhoneNumber::where('country_code', $countryCode)->first();
        $phoneNumber      = false;
        $errorMessage     = false;

        if ($phoneNumberModel === null) {
            try {
                $numbers = app(\Services_Twilio::class)->account->available_phone_numbers->getList($countryCode, 'Local');
                $number  = app(\Services_Twilio::class)->account->incoming_phone_numbers->create(array(
                    "FriendlyName" => "{$countryCode} Number",
                    "VoiceUrl"     => URL::route('twilioRespond'),
                    "PhoneNumber"  => $numbers->available_phone_numbers[0]->phone_number,
                    "VoiceMethod"  => "GET"
                ));

                if ($number) {
                    $phoneNumberModel               = new \app\models\PhoneNumber();
                    $phoneNumberModel->phone_number = $number->phone_number;
                    $phoneNumberModel->sid          = $number->sid;
                    $phoneNumberModel->country_code = $countryCode;
                    $phoneNumberModel->save();
                }
            } catch (\Services_Twilio_RestException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        if ($phoneNumberModel instanceof \app\models\PhoneNumber) {
            $phoneNumber = $phoneNumberModel->phone_number;
        }

        return View::make('call_page')->with('phoneNumber', $phoneNumber)->with('errorMessage', $errorMessage);
    }

}
