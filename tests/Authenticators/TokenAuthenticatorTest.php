<?php

namespace Cpwc\Laravel\Tests\Lta\Authenticators;

use Cpwc\Lta\Client;
use Cpwc\Laravel\Lta\Authenticators\TokenAuthenticator;
use Cpwc\Laravel\Tests\Lta\AbstractTestCase;
use Mockery;

/**
 * This is the token authenticator test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class TokenAuthenticatorTest extends AbstractTestCase
{
    public function testMakeWithMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()
            ->with('your-account-key', 'your-unique-user-id', 'http_token');

        $return = $authenticator->with($client)->authenticate([
            'accountKey'   => 'your-account-key',
            'uniqueUserId' => 'your-unique-user-id',
            'method'       => 'token'
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    public function testMakeWithoutMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()
            ->with('your-account-key', 'your-unique-user-id', 'http_token');

        $return = $authenticator->with($client)->authenticate([
            'accountKey'   => 'your-account-key',
            'uniqueUserId' => 'your-unique-user-id'
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The authenticator requires an accountKey.
     */
    public function testMakeWithoutToken()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);

        $return = $authenticator->with($client)->authenticate([]);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The client instance was not given to the authenticator.
     */
    public function testMakeWithoutSettingClient()
    {
        $authenticator = $this->getAuthenticator();

        $return = $authenticator->authenticate([
            'token'  => 'your-token',
            'method' => 'token',
        ]);
    }

    protected function getAuthenticator()
    {
        return new TokenAuthenticator();
    }
}
