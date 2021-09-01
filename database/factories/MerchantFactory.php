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
                'lat' => 25.0375459767136519,
                'lng' => 121.56224280595779419,
            ],
        ];
    }

    public function taipei_station()
    {
        return $this->state(fn (array $attributes) => [
            'location' => [
                'lat' => 25.047799,
                'lng' => 121.514765,
            ],
        ]);
    }

    public function ticc()
    {
        return $this->state(fn (array $attributes) => [
            'location' => [
                'lat' => 25.0385197,
                'lng' => 121.5605449,
            ],
        ]);
    }
}
