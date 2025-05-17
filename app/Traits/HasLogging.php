<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait HasLogging
{
    /**
     * Logs exception as error, with error code.
     * 
     * @param string $contextMessage
     * @param Exception $exception
     * @return string
     */
    protected function logException(string $contextMessage = '', Exception $exception): string
    {
        $code = $this->generateCode('er', $contextMessage);
        Log::error("Error {$code} $contextMessage", [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
        return $code;
    }

    /**
     * Generate logging code.
     * 
     * @param string $type Logging type which consists of ER (for error).
     * @param string $contextMessage
     * @return string
     */
    private function generateCode(string $type, string $contextMessage = ''): string
    {
        $typePrefix = strtoupper($type);
        $contextPrefix = strtoupper(substr(preg_replace('/\s+/', '', $contextMessage), 0, 3));
        $datetime = now()->format('Ymd-His');
        $random = rand(1000, 9999);
        return "{$typePrefix}-{$contextPrefix}-{$datetime}-{$random}";
    }
}
