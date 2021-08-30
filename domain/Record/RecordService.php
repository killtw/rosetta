<?php


namespace Domain\Record;

use App\Models\Record;
use Str;

class RecordService
{
    public function create(array $data)
    {
        Record::create([
            'uuid' => Str::uuid(),
            'merchant_id' => data_get($data, 'merchant_id'),
            'from' => data_get($data, 'from'),
            'time' => data_get($data, 'time'),
        ]);
    }
}
