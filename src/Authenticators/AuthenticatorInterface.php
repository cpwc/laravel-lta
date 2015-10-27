<?php

namespace Cpwc\Laravel\Lta\Authenticators;

use Cpwc\Lta\Client;

interface AuthenticatorInterface
{
    /**
     * Set the client to perform the authentication on.
     *
     * @param \Cpwc\Lta\Client $client
     *
     * @return \GrahamCampbell\GitHub\Authenticators\AuthenticatorInterface
     */
    public function with(Client $client);

    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Cpwc\Lta\Client
     */
    public function authenticate(array $config);
}
