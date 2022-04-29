<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Laravel\Sanctum\PersonalAccessToken;
// use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Sanctum::authenticateAccessTokensUsing(
        //     static function (PersonalAccessToken $accessToken, bool $is_valid) {
        //         // your logic here
        //         return $accessToken->expired_at ? $is_valid && !$accessToken->expired_at->isPast() : $is_valid;
        //     }
        // );
    }
}
