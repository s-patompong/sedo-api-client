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
        $username = config("{$this->configFileName}.username");
        $password = config("{$this->configFileName}.password");
        $signKey = config("{$this->configFileName}.sign_key");
        $partnerId = config("{$this->configFileName}.partner_id");
        $timeout = config("{$this->configFileName}.timeout");
        $exceptions = config("{$this->configFileName}.exceptions");
        $wsdl = config("{$this->configFileName}.wsdl");

        $sedo = new Sedo($username, $password, $signKey, $partnerId, $timeout, $exceptions, $wsdl);
        $this->app->instance(Sedo::class, $sedo);

        $sedoDomain = new SedoDomain($username, $password, $signKey, $partnerId, $timeout, $exceptions, $wsdl);
        $this->app->instance(SedoDomain::class, $sedoDomain);
    }
}
