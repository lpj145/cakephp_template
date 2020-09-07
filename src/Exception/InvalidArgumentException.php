<?php
declare(strict_types=1);

namespace App\Exception;


use Throwable;

class InvalidArgumentException extends \InvalidArgumentException
{
    const BAD_REQUEST = 400;
    public function __construct(string $message = "", int $code = self::BAD_REQUEST, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
