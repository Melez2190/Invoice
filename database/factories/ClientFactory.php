<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $admin = User::first();
        $user = User::all()->pluck('id')->first();
       
// dd($usersIds);
        return [
            'user_id' => $user,
            'name' => $this->faker->Company(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'account_number' => rand(1000, 100000),
            'id_number' => rand(1000, 100000),
            'tax_number' => rand(100203, 999999),
            'zip_code' => rand(11000, 17000),
            'email' => $this->faker->safeEmail(),
            'phone_number' => rand(60000, 6000000),
            'created_by' => $user,
            

        ];
    }
}