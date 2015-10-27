<?php

namespace Cpwc\Laravel\Tests\Lta;

use Cpwc\Lta\Client;
use Cpwc\Laravel\Lta\Authenticators\AuthenticatorFactory;
use Cpwc\Laravel\Lta\LtaFactory;
use Cpwc\Laravel\Lta\LtaManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testAuthFactoryIsInjectable()
    {
        $this->assertIsInjectable(AuthenticatorFactory::class);
    }

    public function testLtaFactoryIsInjectable()
    {
        $this->assertIsInjectable(LtaFactory::class);
    }

    public function testLtaManagerIsInjectable()
    {
        $this->assertIsInjectable(LtaManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['lta.connection'];
        $this->app['lta']->reconnect();
        $new = $this->app['lta.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
