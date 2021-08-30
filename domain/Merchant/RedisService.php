<?php

namespace Domain\Merchant;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    const KEY = 'merchants';

    /**
     * @param int $merchant_id
     * @param float $lat
     * @param float $lng
     *
     * @return bool
     */
    public function geoAdd(int $merchant_id, float $lat, float $lng): bool
    {
        return ! ! Redis::command('geoadd', [self::KEY, $lng, $lat, $merchant_id]);
    }

    public function geoPos(int $merchant_id): ?array
    {
        $result = Redis::command('geopos', [self::KEY, $merchant_id]);

        return $result[0] ? [
            'lat' => $result[0][1],
            'lng' => $result[0][0],
        ] : null;
    }
}
