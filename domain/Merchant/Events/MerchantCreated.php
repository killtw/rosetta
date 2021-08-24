<?php

namespace Domain\Merchant\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class MerchantCreated extends ShouldBeStored
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string $phone;
    /**
     * @var string
     */
    public string $identity;
    /**
     * @var array
     */
    public array $location;

    /**
     * @param string $name
     * @param string $phone
     * @param string $identity
     * @param array $location
     */
    public function __construct(string $name, string $phone, string $identity, array $location)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->identity = $identity;
        $this->location = $location;
    }
}
