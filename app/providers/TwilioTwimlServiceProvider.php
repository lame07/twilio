<?php

namespace app\providers;

use \Illuminate\Support\ServiceProvider;

class TwilioTwimlServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->bind(\Services_Twilio_Twiml::class, function ($app) {
            return new \Services_Twilio_Twiml();
        });
    }

    public function provides()
    {
        return [\Services_Twilio_Twiml::class];
    }

}
