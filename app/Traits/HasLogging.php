<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait HasLogging
{
    /**
     * Logs exception as error.
     * 
     * @param string $contextMessage
     * @param Exception $exception
     * @return void
     */
    protected function logException(string $contextMessage = '', Exception $exception): void
    {
        Log::error("Error $contextMessage", [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}
