<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    const MERCHANTS_KEY = 'merchants';

    /**
     * @param int $merchant_id
     * @param float $lat
     * @param float $lng
     *
     * @return bool
     */
    public function addMerchant(int $merchant_id, float $lat, float $lng): bool
    {
        return ! ! Redis::command('geoadd', [self::MERCHANTS_KEY, $lng, $lat, $merchant_id]);
    }

    public function getMerchantPos(int $merchant_id): ?array
    {
        $result = Redis::command('geopos', [self::MERCHANTS_KEY, $merchant_id]);

        return $result[0] ? [
            'lat' => $result[0][1],
            'lng' => $result[0][0],
        ] : null;
    }

    public function addRecordToMerchant(int $merchant_id, string $member, int $timestamp): bool
    {
        $key = sprintf(self::MERCHANTS_KEY . ':%s', $merchant_id);

        return ! ! Redis::command('zadd', [$key, $timestamp, $member]);
    }
}
