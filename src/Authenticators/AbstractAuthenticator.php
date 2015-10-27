<?php

namespace Cpwc\Laravel\Lta\Authenticators;

use Cpwc\Lta\Client;

abstract class AbstractAuthenticator
{
    /**
     * The client to perform the authentication on.
     *
     * @var \Cpwc\Lta\Client|null
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \Cpwc\Lta\Client $client
     *
     * @return \Cpwc\Laravel\Lta\Authenticators\AuthenticatorInterface
     */
    public function with(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
