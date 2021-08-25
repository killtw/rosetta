<?php

namespace Domain\Merchant;

use App\Models\Merchant;
use Str;

class MerchantService
{
    /**
     * @param array $data
     *
     * @return \App\Models\Merchant
     */
    public function create(array $data): Merchant
    {
        $uuid = Str::uuid();
        MerchantAggregate::retrieve($uuid)->create($data)->persist();

        return Merchant::where('uuid', $uuid)->firstOrFail();
    }
}
