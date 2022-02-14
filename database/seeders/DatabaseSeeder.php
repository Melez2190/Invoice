<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        

        Client::factory(5)->create();
        Invoice::factory(10)->create();
        Item::factory(50)->create();
    }
}
