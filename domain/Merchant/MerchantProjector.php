<?php

namespace Domain\Merchant;

use App\Models\Merchant;
use Domain\Merchant\Events\MerchantCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class MerchantProjector extends Projector
{
    /**
     * @param \Domain\Merchant\Events\MerchantCreated $event
     */
    public function onMerchantCreated(MerchantCreated $event): void
    {
        Merchant::create([
            'uuid' => $event->aggregateRootUuid(),
            'name' => $event->name,
            'phone' => $event->phone,
            'identity' => $event->identity,
            'location' => $event->location,
        ]);
    }
}
