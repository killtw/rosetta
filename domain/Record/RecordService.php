<?php


namespace Domain\Record;

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
}
