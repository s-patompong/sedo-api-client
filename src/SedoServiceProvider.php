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
        $wsdl = config("{$this->configFileName}.wsdl");
        $isLog = config("{$this->configFileName}.log");
        $logPath = config("{$this->configFileName}.log_path");

        $sedo = new Sedo($username, $password, $signKey, $partnerId, $timeout, $wsdl);
        $sedo->setIsLog($isLog)->setLogPath($logPath);
        $this->app->instance(Sedo::class, $sedo);

        $sedoDomain = new SedoDomain($username, $password, $signKey, $partnerId, $timeout, $wsdl);
        $sedoDomain->setIsLog($isLog)->setLogPath($logPath);
        $this->app->instance(SedoDomain::class, $sedoDomain);
    }
}
