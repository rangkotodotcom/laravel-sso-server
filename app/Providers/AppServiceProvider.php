<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Google\Provider as GoogleProvider;
use SocialiteProviders\Azure\Provider as AzureProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::$registersJsonApiRoutes = true;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::authorizationView('auth.oauth.authorize');
        Passport::deviceUserCodeView('auth.oauth.device.user-code');
        Passport::deviceAuthorizationView('auth.oauth.device.authorize');
        Passport::loadKeysFrom(storage_path());
        Passport::enablePasswordGrant();
        Passport::enableImplicitGrant();
        Passport::tokensExpireIn(CarbonInterval::days(7));
        Passport::refreshTokensExpireIn(CarbonInterval::days(14));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(1));


        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('google', GoogleProvider::class);
            $event->extendSocialite('azure', AzureProvider::class);
        });
    }
}
