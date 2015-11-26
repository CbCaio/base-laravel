<?php

namespace BaseLaravel\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('letters_spaces', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\pL\h]+$/u', $value);
        });

        Validator::replacer('letters_spaces', function ($message, $attribute, $rule, $parameters) {
            return "o Campo $attribute só pode conter letras e espaços.";
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
