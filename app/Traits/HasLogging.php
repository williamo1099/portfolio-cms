<?php

use Illuminate\Support\Facades\Log;

trait HasLogging
{
    /**
     * 
     */
    protected function logException(string $contextMessage = '', Exception $exception)
    {
        Log::error("Error $contextMessage", [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}
