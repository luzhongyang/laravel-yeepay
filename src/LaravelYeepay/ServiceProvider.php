<?php

namespace Overtrue\LaravelWechat;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Overtrue\Wechat\Wechat;
use Yeepay\YeepayMPay;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('yeepay.php'),
        ], 'config');
    }

    /**
     * Register the provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('yeepay', function($app)
        {
            $config = $app['config']->get('yeepay', []);
            return new YeepayMPay(
                $config['merchant_account'],
                $config['merchant_public_key'],
                $config['merchant_private_key'],
                $config['yeepay_public_key']
            );
        });
    }
}