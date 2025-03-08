<?php

namespace App\Helpers;

use App\Exceptions\ParseJsonException;
use JsonException;

class CacheHelper
{
    /**
     * @param string $baseKey
     * @param array $data
     * @return string
     * @throws ParseJsonException
     */
    public static function generateCacheKey(string $baseKey, array $data = []): string
    {
        if (empty($data)) {
            return $baseKey;
        }
        try {
            ksort($data);
            $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

            return sprintf('%s:%s', $baseKey, hash('sha256', $jsonData));
        } catch (JsonException $e) {
            throw new ParseJsonException("Generate cache key with baseKey {$baseKey} failed", [
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
