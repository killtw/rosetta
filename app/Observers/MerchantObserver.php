<?php

namespace App\Observers;

use App\Models\Merchant;

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

    }
}
