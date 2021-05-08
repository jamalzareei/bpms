<?php

namespace Database\Factories;

use App\Models\Pi;
use Illuminate\Database\Eloquent\Factories\Factory;

class PiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'code' => $this->faker->unique()->numberBetween(1, 1000), 
            'user_id' => 1, 
            'customer_id' => 1, 
            'issud_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),//->dateTime($max = 'now', $timezone = null), 
            'confirm_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),//->dateTime($max = 'now', $timezone = null), 
            'producing' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'stock' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'booking' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'trucks_factory' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'trucks_on_way' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'trucks_on_border' => $this->faker->randomNumber($nbDigits = NULL, $strict = false), 
            'trucks_vend_on_way' => $this->faker->randomNumber($nbDigits = NULL, $strict = false)
        ];
    }
}
