<?php

namespace Domain\Record\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class RecordCreated extends ShouldBeStored implements ShouldQueue
{
    /**
     * @var int
     */
    public int $merchant_id;
    /**
     * @var string
     */
    public string $from;
    /**
     * @var string
     */
    public string $time;

    public function __construct(int $merchant_id, string $from, string $time)
    {
        $this->merchant_id = $merchant_id;
        $this->from = $from;
        $this->time = $time;
    }
}
