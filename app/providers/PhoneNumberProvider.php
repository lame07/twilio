<?php

namespace app\providers;

class PhoneNumberProvider
{

    protected $countryCode;
    protected $phoneNumber;

    public function __construct($countryCode)
    {
        $this->countryCode = strtoupper($countryCode);
    }

    public function getPhoneNumber()
    {
        $this->phoneNumber = \app\models\PhoneNumber::where('country_code', $this->countryCode)->first();

        if ($this->phoneNumber === null) {
            $this->createPhoneNumber();
        }

        return $this->phoneNumber;
    }

    public function createPhoneNumber()
    {
        $numbers = app(\Services_Twilio::class)->account->available_phone_numbers->getList($this->countryCode, 'Local');
        $number  = app(\Services_Twilio::class)->account->incoming_phone_numbers->create(array(
            "FriendlyName" => "{$this->countryCode} Number",
            "VoiceUrl"     => URL::route('twilioRespond'),
            "PhoneNumber"  => $numbers->available_phone_numbers[0]->phone_number,
            "VoiceMethod"  => "GET"
        ));

        if (is_object($number)) {
            $this->phoneNumber               = new \app\models\PhoneNumber();
            $this->phoneNumber->phone_number = $number->phone_number;
            $this->phoneNumber->sid          = $number->sid;
            $this->phoneNumber->country_code = $this->countryCode;
            $this->phoneNumber->save();
        }
    }

}
