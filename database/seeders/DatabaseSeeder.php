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
        $this->call(RoleSeeder::class);
        $this->call(AdminUserSeeder::class);
    }
}
