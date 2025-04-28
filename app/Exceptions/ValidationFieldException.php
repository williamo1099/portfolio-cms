<?php

namespace App\Exceptions;

use Exception;

class ValidationFieldException extends Exception
{
    protected string $field;

    public function __construct(string $field, string $message)
    {
        parent::__construct($message);
        $this->field = $field;
    }

    public function getField(): string
    {
        return $this->field;
    }
}
