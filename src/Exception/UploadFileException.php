<?php
declare(strict_types=1);

namespace App\Exception;


use Throwable;

class UploadFileException extends \RuntimeException
{
    const DEFAULT_ERROR_MESSAGE = 'Upload file failed, because this file is wrong.';
    const BAD_REQUEST = 400;

    private $errors = [];

    public function __construct(array $errors, Throwable $previous = null)
    {
        parent::__construct(self::DEFAULT_ERROR_MESSAGE, self::BAD_REQUEST, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
