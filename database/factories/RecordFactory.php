<?php

namespace Database\Factories;

use App\Models\Merchant;
use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'merchant_id' => Merchant::factory(),
            'from' => '0987654321',
            'time' => now(),
        ];
    }
}
