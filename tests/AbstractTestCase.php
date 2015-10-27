<?php

namespace Cpwc\Laravel\Tests\Lta;

use Cpwc\Laravel\Lta\LtaServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

/**
 * This is the abstract test case class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return LtaServiceProvider::class;
    }
}
