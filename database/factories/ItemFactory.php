<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id')->first();

        $ids = Invoice::all()->pluck('id')->toArray();
         return [
            'invoice_id' => array_rand(array_flip($ids)),
            'description' => $this->faker->jobTitle(),
            'price'=> $this->faker->randomFloat(2, 20, 999999),
            'quantity' => rand(1, 150),
            'pdv' => 18,
            'created_by' => $user,
        ];
    }
}