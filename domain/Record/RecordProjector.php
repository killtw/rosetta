<?php

namespace Domain\Record;

use App\Models\Record;
use Domain\Record\Events\RecordCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class RecordProjector extends Projector
{
    public function onRecordCreated(RecordCreated $event)
    {
        Record::create([
            'uuid' => $event->aggregateRootUuid(),
            'merchant_id' => $event->merchant_id,
            'from' => $event->from,
            'time' => $event->time,
        ]);
    }
}
