<?php

namespace Tests\Unit\Services;

use App\Services\MerchantService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
