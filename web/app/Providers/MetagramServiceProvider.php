<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MetagramServiceProvider extends ServiceProvider
{
    public function register ()
    {
        $this->app->bind('metagram', 'App\Services\MetagramService');
    }
}