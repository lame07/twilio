<?php

namespace app\providers;

use \Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton(\Services_Twilio::class, function ($app) {
            return new \Services_Twilio(getenv('TWILIO_API_SID'), getenv('TWILIO_API_TOKEN'));
        });
    }

    public function provides()
    {
        return [\Services_Twilio::class];
    }

}
