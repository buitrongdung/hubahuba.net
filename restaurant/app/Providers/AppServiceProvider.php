<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Check given password against password stored in database
        Validator::extend('hashmatch', function($attribute, $value, $parameters)
        {
            $user = User::find($parameters[0]);

            return Hash::check($value, $user->password);
        });

        // Check that given password is not the same as the password stored in database
        Validator::extend('hashdiffer', function($attribute, $value, $parameters)
        {
            $user = User::find($parameters[0]);

            return !Hash::check($value, $user->password);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );
    }
}
