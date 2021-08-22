<?php


namespace App\Services;

use App\Models\Merchant;

class MerchantService
{
    /**
     * @param array $data
     *
     * @return \App\Models\Merchant
     */
    public function create(array $data): Merchant
    {
        return Merchant::create([
            'name' => data_get($data, 'name'),
            'phone' => data_get($data, 'phone'),
            'identity' => data_get($data, 'identity'),
            'location' => data_get($data, 'location'),
        ]);
    }
}
