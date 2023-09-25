<?php

namespace Database\Factories;

use App\Models\dutyStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class dutyStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = dutyStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement($array = array ('present','absent','day off')),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
          
       
        ];
    }
}
