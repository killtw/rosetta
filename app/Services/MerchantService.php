<?php

namespace App\Services;

use App\Models\Merchant;
use Geocoder;
use Spatie\Geocoder\Exceptions\CouldNotGeocode;

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
            'location' => data_get($data, 'location') ?: $this->getCoordinates(data_get($data, 'address')),
        ]);
    }

    /**
     * @param string $address
     *
     * @return array
     */
    protected function getCoordinates(string $address): array
    {
        $response = Geocoder::getCoordinatesForAddress($address);

        return [
            'lat' => data_get($response, 'lat'),
            'lng' => data_get($response, 'lng'),
        ];
    }
}
