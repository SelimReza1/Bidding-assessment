<?php

namespace App\Exceptions;

use Exception;

class BidDeadlineReachedException extends Exception
{
    protected $code = 120;

    protected $message = "The deadline of the product has reached! You can't place any bid anymore.";
}
