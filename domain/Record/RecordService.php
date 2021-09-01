<?php

namespace Domain\Record;

use App\Services\RedisService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RecordService
{
    /**
     * @param array $data
     */
    public function create(array $data): void
    {
        RecordAggregate::retrieve(Str::uuid())->create($data)->persist();
    }

    public function search(int $merchant_id, string $time): Collection
    {
        $result = app(RedisService::class)->getRecordFromMerchantIn7Days($merchant_id, Carbon::parse($time)->toImmutable());

        return collect($result)->transform(fn ($record, $key) => ['from' => explode(':', $key)[0], 'time' => $record])->values();
    }
}
