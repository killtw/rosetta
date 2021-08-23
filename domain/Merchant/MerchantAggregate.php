<?php

namespace Domain\Merchant;

use Domain\Merchant\Events\MerchantCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Spatie\Geocoder\Facades\Geocoder;

class MerchantAggregate extends AggregateRoot
{
    /**
     * @param array $data
     *
     * @return $this
     */
    public function create(array $data): self
    {
        $name = data_get($data, 'name');
        $phone = data_get($data, 'phone');
        $identity = data_get($data, 'identity');
        $location = data_get($data, 'location') ?: $this->getCoordinates(data_get($data, 'address'));

        return $this->recordThat(new MerchantCreated($name, $phone, $identity, $location));
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
