<?php

namespace Tests\Unit\Merchant;

use Domain\Merchant\Events\MerchantCreated;
use Domain\Merchant\MerchantAggregate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Geocoder\Facades\Geocoder;
use Tests\TestCase;

class MerchantAggregateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_could_create_merchant()
    {
        // arrange
        $expected = [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identity' => 'A123456789',
            'location' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
        ];

        // act
        $actual = MerchantAggregate::fake()
            ->when(fn (MerchantAggregate $aggregate) => $aggregate->create($expected));

        // assert
        $actual->assertRecorded([new MerchantCreated($expected['name'], $expected['phone'], $expected['identity'], $expected['location'])]);
    }

    /** @test */
    public function it_could_create_merchant_with_address()
    {
        // arrange
        $data = [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identity' => 'A123456789',
            'address' => '台北市信義區市府路1號',
        ];
        $expected = [
            'lat' => 25.0381727,
            'lng' => 121.5643485,
        ];
        Geocoder::shouldReceive('getCoordinatesForAddress')
            ->with($data['address'])
            ->andReturn([
                'lat' => 25.0381727,
                'lng' => 121.5643485,
            ]);

        // act
        $actual = MerchantAggregate::fake()
            ->when(fn (MerchantAggregate $aggregate) => $aggregate->create($data));

        // assert
        $actual->assertRecorded([new MerchantCreated($data['name'], $data['phone'], $data['identity'], $expected)]);
    }
}
