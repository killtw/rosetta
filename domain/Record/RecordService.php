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
        $merchants = app(RedisService::class)->getNearMerchants($merchant_id);
        $immutable_time = Carbon::parse($time)->toImmutable();

        return collect($merchants)->map(fn ($merchant_id) => app(RedisService::class)->getRecordFromMerchantIn7Days($merchant_id, $immutable_time))
            ->collapse()
            ->transform(fn ($record, $key) => ['from' => explode(':', $key)[0], 'time' => $record])->values();
    }
}
