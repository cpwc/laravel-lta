<?php

namespace Cpwc\Laravel\Lta\Authenticators;

use InvalidArgumentException;

class AuthenticatorFactory
{
    /**
     * Make a new authenticator instance.
     *
     * @param string $method
     *
     * @return \Cpwc\Laravel\Lta\Authenticators\AuthenticatorInterface
     */
    public function make($method)
    {
        switch ($method) {
            case 'token':
                return new TokenAuthenticator();
        }

        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
