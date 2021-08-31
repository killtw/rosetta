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
        $member = "$record->from:$record->uuid";

        app(RedisService::class)->addRecordToMerchant($record->merchant_id, $member, $record->time->timestamp);
    }
}
