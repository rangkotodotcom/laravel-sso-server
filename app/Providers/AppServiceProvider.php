<?php

namespace App\Providers;

// use Inertia\Inertia;
use Laravel\Passport\Passport;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;

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



        // Passport::authorizationView(
        //     fn ($parameters) => Inertia::render('Auth/OAuth/Authorize', [
        //         'request' => $parameters['request'],
        //         'authToken' => $parameters['authToken'],
        //         'client' => $parameters['client'],
        //         'user' => $parameters['user'],
        //         'scopes' => $parameters['scopes'],
        //     ])
        // );
    }
}
