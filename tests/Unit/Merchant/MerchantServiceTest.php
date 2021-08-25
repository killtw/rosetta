<?php

namespace Tests\Unit\Merchant;

use Domain\Merchant\MerchantService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Geocoder\Facades\Geocoder;
use Tests\TestCase;

class MerchantServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_should_create_and_return_a_merchant_model()
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
        $actual = app(MerchantService::class)->create($expected);

        // assert
        $this->assertSame($expected['name'], $actual->name);
        $this->assertDatabaseHas('merchants', ['name' => $expected['name']]);
    }

    /** @test */
    public function it_should_create_a_merchant_by_address()
    {
        // arrange
        $expected = [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identity' => 'A123456789',
            'address' => '台北市信義區市府路1號',
        ];
        Geocoder::shouldReceive('getCoordinatesForAddress')
            ->with($expected['address'])
            ->andReturn([
                'lat' => 25.0381727,
                'lng' => 121.5643485,
            ]);

        // act
        $actual = app(MerchantService::class)->create($expected);

        // assert
        $this->assertSame(25.0381727, $actual->location['lat']);
        $this->assertSame(121.5643485, $actual->location['lng']);
        $this->assertDatabaseHas('merchants', ['name' => $expected['name']]);
    }
}
