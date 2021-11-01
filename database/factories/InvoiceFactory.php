<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clients = Client::all()->pluck('id');
        foreach ($clients as $id) {
            $ids[] = $id;
        }
        return [
            'client_id' => array_rand(array_flip($ids)),
            'date_of_issue' => $this->faker->date(),
            'valuta' => $this->faker->date(),
            'status' => 0


        ];
    }
}