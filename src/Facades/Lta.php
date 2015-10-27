<?php

namespace Cpwc\Laravel\Lta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the lta facade class.
 *
 * @author Poh Wei Cheng <calvinpohwc@gmail.com>
 */
class Lta extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lta';
    }
}
