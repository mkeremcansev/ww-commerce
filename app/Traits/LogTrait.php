<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    /**
     * @param  null  $extraWarning
     * @param  null  $extraTwoWarning
     */
    private static function log($className, $getMessage, $getLine, $extraWarning = null, $extraTwoWarning = null): void
    {
        Log::channel('warning')
            ->info([
                $className => [
                    'getMessage' => $getMessage,
                    'getLine' => $getLine,
                    'extraWarning' => $extraWarning,
                    'extraTwoWarning' => $extraTwoWarning,
                ],
            ]);
    }
}
