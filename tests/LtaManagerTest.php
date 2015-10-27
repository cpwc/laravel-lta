<?php

namespace Cpwc\Laravel\Tests\Lta;

use Cpwc\Lta\Client;
use Cpwc\Laravel\Lta\LtaFactory;
use Cpwc\Laravel\Lta\LtaManager;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;

/**
 * This is the lta manager test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class LtaManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['accountKey' => 'your-account-key', 'uniqueUserId' => 'your-unique-user-id'];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('lta-datamall.default')->andReturn('main');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('main', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(LtaFactory::class);

        $manager = new LtaManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('lta-datamall.connections')->andReturn(['main' => $config]);

        $config['name'] = 'main';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
