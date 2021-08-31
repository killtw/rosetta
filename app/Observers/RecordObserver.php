<?php

namespace App\Observers;

use App\Models\Record;
use App\Services\RedisService;

class RecordObserver
{
    /**
     * Handle the Record "created" event.
     *
     * @param \App\Models\Record $record
     *
     * @return void
     */
    public function created(Record $record): void
    {
        app(RedisService::class)->addRecordToMerchant($record->merchant_id, $record->from, $record->time->timestamp);
    }
}
