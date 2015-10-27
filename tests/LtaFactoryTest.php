<?php

namespace Cpwc\Laravel\Tests\Lta;

use Cpwc\Lta\Client;
use Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory;
use Cpwc\Laravel\Lta\LtaFactory;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

/**
 * This is the lta factory test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class LtaFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getFactory();

        $client = $factory->make([
            'accountKey'   => 'your-account-key',
            'uniqueUserId' => 'your-unique-user-id',
            'method'       => 'token'
        ]);

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [bar].
     */
    public function testMakeInvalidMethod()
    {
        $factory = $this->getFactory();

        $factory->make(['method' => 'bar']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported authentication method [].
     */
    public function testMakeEmpty()
    {
        $factory = $this->getFactory();

        $factory->make([]);
    }

    protected function getFactory()
    {
        return new LtaFactory(new AuthenticatorFactory(), __DIR__);
    }
}
