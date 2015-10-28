<?php

namespace Cpwc\Laravel\Lta;

use Cpwc\Lta\Client;
use Cpwc\Lta\HttpClient\HttpClient;
use Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory;

class LtaFactory
{
    /**
     * The authenticator factory instance.
     *
     * @var \Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory
     */
    protected $auth;

    /**
     * The cache path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new lta factory instance.
     *
     * @param string $path
     *
     * @return void
     */
    public function __construct(AuthenticatorFactory $auth, $path)
    {
        $this->auth = $auth;
        $this->path = $path;
    }

    /**
     * Make a new lta client.
     *
     * @param string[] $config
     *
     * @return \Cpwc\Lta\Client
     */
    public function make(array $config)
    {
        $http = $this->getHttpClient($config);

        return $this->getClient($http, $config);
    }

    /**
     * Get the http client.
     *
     * @param string[] $config
     *
     * @return \Cpwc\Lta\HttpClient\HttpClient
     */
    protected function getHttpClient(array $config)
    {
//        $options = [
//            'base_url'    => array_get($config, 'baseUrl', 'https://api.github.com/'),
//            'api_version' => array_get($config, 'version', 'v3'),
//            'cache_dir'   => $this->path,
//        ];

        return new HttpClient();
    }

    /**
     * Get the main client.
     *
     * @param \Cpwc\Lta\HttpClient\HttpClient $http
     * @param string[]                        $config
     *
     * @return \Cpwc\Lta\Client
     */
    protected function getClient(HttpClient $http, array $config)
    {
        $client = new Client($http);

        return $this->auth->make(array_get($config, 'method'))->with($client)->authenticate($config);
    }
}
