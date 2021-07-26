<?php

namespace Database\Factories\Pivots;

use App\Models\Pivots\OrderUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        OrderUser::flushEventListeners();
        return [
            'delivery' => $this->faker->randomFloat,
            'qty' => $this->faker->randomDigit
        ];
    }
}
