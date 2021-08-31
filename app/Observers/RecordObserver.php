<?php

namespace App\Observers;

use App\Models\Record;

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
        //
    }
}
