<?php

namespace App\Observers;

use App\Models\Merchant;
use App\Services\RedisService;

class MerchantObserver
{
    /**
     * Handle the Merchant "created" event.
     *
     * @param \App\Models\Merchant $merchant
     *
     * @return void
     */
    public function created(Merchant $merchant): void
    {
        app(RedisService::class)->addMerchant($merchant->id, data_get($merchant->location, 'lat'), data_get($merchant->location, 'lng'));
    }
}
