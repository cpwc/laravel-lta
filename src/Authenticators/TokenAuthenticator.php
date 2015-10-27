<?php

namespace Cpwc\Laravel\Lta\Authenticators;

use InvalidArgumentException;

class TokenAuthenticator extends AbstractAuthenticator implements AuthenticatorInterface
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Cpwc\Lta\Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the authenticator.');
        }

        if (!array_key_exists('accountKey', $config)) {
            throw new InvalidArgumentException('The authenticator requires an accountKey.');
        }

        if (!array_key_exists('uniqueUserId', $config)) {
            throw new InvalidArgumentException('The authenticator requires an uniqueUserId.');
        }

        $this->client->authenticate($config['accountKey'], $config['uniqueUserId'], 'http_token');

        return $this->client;
    }
}
