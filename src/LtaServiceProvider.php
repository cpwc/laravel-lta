<?php

namespace Cpwc\Laravel\Lta;

use Cpwc\Lta\Client;
use Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LtaServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__ . '/../config/lta-datamall.php');

        if (class_exists('Illuminate\Foundation\Application', false) && $app->runningInConsole()) {
            $this->publishes([$source => config_path('lta-datamall.php')]);
        } elseif (class_exists('Laravel\Lumen\Application', false)) {
            $app->configure('lta-datamall');
        }

        $this->mergeConfigFrom($source, 'lta-datamall');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAuthFactory($this->app);
        $this->registerLtaFactory($this->app);
        $this->registerManager($this->app);
        $this->registerBindings($this->app);
    }

    /**
     * Register the auth factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerAuthFactory(Application $app)
    {
        $app->singleton('lta.authfactory', function () {
            return new AuthenticatorFactory();
        });

        $app->alias('lta.authfactory', AuthenticatorFactory::class);
    }

    /**
     * Register the lta factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerLtaFactory(Application $app)
    {
        $app->singleton('lta.factory', function ($app) {
            $auth = $app['lta.authfactory'];
            $path = $app['path.storage'] . '/lta';

            return new LtaFactory($auth, $path);
        });

        $app->alias('lta.factory', LtaFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('lta', function ($app) {
            $config = $app['config'];
            $factory = $app['lta.factory'];

            return new LtaManager($config, $factory);
        });

        $app->alias('lta', LtaManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('lta.connection', function ($app) {
            $manager = $app['lta'];

            return $manager->connection();
        });

        $app->alias('lta.connection', Client::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'lta.authfactory',
            'lta.factory',
            'lta',
            'lta.connection',
        ];
    }
}
