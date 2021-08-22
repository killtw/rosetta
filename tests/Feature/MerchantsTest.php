<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MerchantsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_should_create_and_return_a_merchant_model_with_http_200()
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
        $actual = $this->postJson(route('merchants.store'), $expected);

        // assert
        $actual
            ->assertCreated()
            ->assertJson([
                'message' => 'success',
                'data' => $expected,
            ]);
    }

    /** @test */
    public function it_should_return_error_when_validation_failed()
    {
        // arrange
        $expected = [
            'identity' => 'A123456789',
            'location' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
        ];

        // act
        $actual = $this->postJson(route('merchants.store'), $expected);

        // assert
        $actual
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ])
            ->assertJsonValidationErrors([
                'name' => 'The name field is required.',
                'phone' => 'The phone field is required.',
            ]);
    }

    /** @test */
    public function it_should_return_error_when_identity_validation_failed()
    {
        // arrange
        $expected = [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identity' => 'A123456781',
            'location' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
        ];

        // act
        $actual = $this->postJson(route('merchants.store'), $expected);

        // assert
        $actual
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ])
            ->assertJsonValidationErrors([
                'identity' => 'identity 不是合法的身分證字號',
            ]);
    }
}
