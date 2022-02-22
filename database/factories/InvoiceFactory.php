<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


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
        $clients = Client::all()->pluck('id')->toArray();
        $user = User::all()->pluck('id')->first();
       

        foreach(range(1, 120) as $index)
        {

            $year = rand(2009, 2016);
            $month = rand(1, 12);
            $day = rand(1, 28);

            $date = Carbon::create($year,$month ,$day , 0, 0, 0);
            
           

         
            return [
                'client_id' => array_rand(array_flip($clients)),
                'date_of_issue' => Carbon::create($year,$month ,$day , 0, 0, 0),
                'valuta'  => $date->addWeeks(rand(1, 260)),
                'status' => 0,
                'created_by' => $user,

            ];
        }

      
    }
   
}