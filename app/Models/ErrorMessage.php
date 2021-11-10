<?php

namespace App\Models;

class ErrorMessage
{
    public int $httpStatus;
    public string $errorMessage;

    public function __construct(int $httpStatus, string $errorMessage)
    {
        $this->httpStatus = $httpStatus;
        $this->errorMessage = $errorMessage;
    }
}