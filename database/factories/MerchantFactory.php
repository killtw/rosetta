<?php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Merchant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'identity' => 'A123456789',
            'location' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
        ];
    }
}