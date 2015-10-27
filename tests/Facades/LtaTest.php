<?php

namespace Cpwc\Laravel\Tests\Lta\Facades;

use Cpwc\Laravel\Lta\Facades\Lta;
use Cpwc\Laravel\Lta\LtaManager;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use Cpwc\Laravel\Tests\Lta\AbstractTestCase;

/**
 * This is the lta facade test class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class LtaTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'lta';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Lta::class;
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return LtaManager::class;
    }
}
