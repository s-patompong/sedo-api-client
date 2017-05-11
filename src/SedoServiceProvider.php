<?php


namespace SedoClient;

use Illuminate\Support\ServiceProvider;

class SedoServiceProvider extends ServiceProvider
{
    private $configFileName = 'sedo';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../config/{$this->configFileName}.php" => config_path("{$this->configFileName}.php"),
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
                config("{$this->configFileName}.username"),
                config("{$this->configFileName}.password"),
                config("{$this->configFileName}.sign_key"),
                config("{$this->configFileName}.partner_id"),
                config("{$this->configFileName}.timeout"),
                config("{$this->configFileName}.exceptions"),
                config("{$this->configFileName}.wsdl")
            );
        });
    }
}
