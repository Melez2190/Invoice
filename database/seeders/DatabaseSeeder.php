<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(5)->create();
        Invoice::factory(10)->create();
        Item::factory(30)->create();
    }
}
