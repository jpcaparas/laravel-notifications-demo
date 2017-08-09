<?php

namespace App\Traits;

/**
 * Trait GetsTime
 *
 * @package App\Traits
 */
trait GetsTime
{
    /**
     * @return string The date now in YYYY-mm-dd format
     */
    function now()
    {
        return \Carbon\Carbon::now()->toDateTimeString();
    }
}