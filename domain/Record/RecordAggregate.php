<?php

namespace Domain\Record;

use Domain\Record\Events\RecordCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class RecordAggregate extends AggregateRoot
{
    /**
     * @param array $data
     *
     * @return $this
     */
    public function create(array $data): self
    {
        $merchant_id = data_get($data, 'merchant_id');
        $from = data_get($data, 'from');
        $time = data_get($data, 'time');

        return $this->recordThat(new RecordCreated($merchant_id, $from, $time));
    }
}
