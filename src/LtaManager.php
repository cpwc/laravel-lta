<?php

namespace Cpwc\Laravel\Lta;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the lta manager class.
 *
 * @method \Cpwc\Lta\Api\BusArrival busArrival()
 * @method \Cpwc\Lta\Api\ApiInterface api(string $name)
 * @method void authenticate(string $accountKey, string $uniqueUserId, string|null $authMethod = null)
 * @method \Cpwc\Lta\HttpClient\HttpClientInterface getHttpClient()
 * @method void setHttpClient(\Cpwc\Lta\HttpClient\HttpClientInterface $httpClient)
 * @method void clearHeaders()
 * @method void setHeaders(array $headers)
 * @method mixed getOption(string $name)
 * @method void setOption(string $name, mixed $value)
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class LtaManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Cpwc\Laravel\Lta\LtaFactory
     */
    protected $factory;

    /**
     * Create a new lta manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Cpwc\Laravel\Lta\LtaFactory            $factory
     *
     * @return void
     */
    public function __construct(Repository $config, LtaFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Cpwc\Lta\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'lta-datamall';
    }

    /**
     * Get the factory instance.
     *
     * @return \Cpwc\Laravel\Lta\LtaFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
