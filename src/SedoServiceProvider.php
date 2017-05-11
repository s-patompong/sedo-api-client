<?php


namespace SedoClient;

use Illuminate\Support\ServiceProvider;

class SedoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/sedo.php' => config_path('sedo.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Sedo::class, function ($app) {
            return new Sedo(
                config('username'),
                config('password'),
                config('sign_key'),
                config('partner_id'),
                config('timeout'),
                config('exceptions'),
                config('wsdl')
            );
        });
    }
}