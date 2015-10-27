<?php

namespace Cpwc\Laravel\Tests\Lta\Authenticators;

use Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory;
use Cpwc\Laravel\Lta\Authenticators\TokenAuthenticator;
use Cpwc\Laravel\Tests\Lta\AbstractTestCase;

/**
 * This is the authenticator factory test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class AuthenticatorFactoryTest extends AbstractTestCase
{
    public function testMakeTokenAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make('token');

        $this->assertInstanceOf(TokenAuthenticator::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [foo].
     */
    public function testMakeInvalidAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [].
     */
    public function testMakeNoAuthenticator()
    {
        $factory = $this->getFactory();

        $return = $factory->make(null);
    }

    protected function getFactory()
    {
        return new AuthenticatorFactory();
    }
}
