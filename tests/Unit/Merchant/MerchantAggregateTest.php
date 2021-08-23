<?php

namespace Tests\Unit\Merchant;

use Domain\Merchant\Events\MerchantCreated;
use Domain\Merchant\MerchantAggregate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
