<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

    /**
     * @param int $merchant_id
     *
     * @return array|null
     */
    public function getMerchantPos(int $merchant_id): ?array
    {
        $result = Redis::command('geopos', [self::MERCHANTS_KEY, $merchant_id]);

        return $result[0] ? [
            'lat' => $result[0][1],
            'lng' => $result[0][0],
        ] : null;
    }

    /**
     * @param int $merchant_id
     * @param string $member
     * @param int $timestamp
     *
     * @return bool
     */
    public function addRecordToMerchant(int $merchant_id, string $member, int $timestamp): bool
    {
        $key = sprintf(self::MERCHANTS_KEY . ':%s', $merchant_id);

        return ! ! Redis::command('zadd', [$key, $timestamp, $member]);
    }

    /**
     * @param int $merchant_id
     * @param \Carbon\CarbonImmutable $time
     *
     * @return array
     */
    public function getRecordFromMerchantIn7Days(int $merchant_id, CarbonImmutable $time): array
    {
        $key = sprintf(self::MERCHANTS_KEY . ':%s', $merchant_id);

        return Redis::command('zrangebyscore', [$key, $time->subDays(8)->timestamp, $time->timestamp, ['WITHSCORES' => true]]);
    }
}
