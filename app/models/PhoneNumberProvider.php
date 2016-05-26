<?php

namespace models;

class PhoneNumberProvider
{

    protected $twilioClient;
    protected $countryCode;
    protected $phoneNumber;

    public function __construct(\Services_Twilio $twilioClient, $countryCode)
    {
        $this->twilioClient = $twilioClient;
        $this->countryCode  = strtoupper($countryCode);
    }

    public function getPhoneNumber()
    {
        if (!$this->loadPhoneNumber()) {
            $this->createPhoneNumber();
        }

        return $this->phoneNumber;
    }

    public function loadPhoneNumber()
    {
        return $this->phoneNumber = \models\PhoneNumber::where('country_code', $this->countryCode)
            ->first();
    }

    public function createPhoneNumber()
    {
        $numbers = $this->twilioClient->account->available_phone_numbers->getList($this->countryCode, 'Local');
        $number  = $this->twilioClient->account->incoming_phone_numbers->create(array(
            "FriendlyName" => "{$this->countryCode} Number",
            "VoiceUrl"     => "http://{$_SERVER['HTTP_HOST']}" . dirname($_SERVER['SCRIPT_NAME']) . "/twilioRespond",
            "PhoneNumber"  => $numbers->available_phone_numbers[0]->phone_number,
            "VoiceMethod"  => "GET"
        ));

        if ($number) {
            $this->phoneNumber               = new \models\PhoneNumber();
            $this->phoneNumber->phone_number = $number->phone_number;
            $this->phoneNumber->sid          = $number->sid;
            $this->phoneNumber->country_code = $this->countryCode;
            $this->phoneNumber->save();
        }
    }

}
