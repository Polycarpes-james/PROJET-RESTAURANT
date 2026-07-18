<?php

namespace App\Exceptions;

use Exception;

class PlatIndisponibleException extends Exception
{
    public function __construct(public string $raison,string $message = "Ce plat est actuellement indisponible.",int $code = 0) {
        parent::__construct($message, $code);
    }
}
