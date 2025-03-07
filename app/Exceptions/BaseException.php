<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Log;

class BaseException extends \Exception
{
    private array $context;
    public function __construct(string $message = "", $context = [], int $code = 0, $previous = null)
    {
        $this->context = $context;
        $this->logException();
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return void
     */
    private function logException(): void
    {
        Log::critical($this->message, $this->context);
    }
}
