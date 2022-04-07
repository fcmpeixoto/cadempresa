<?php

namespace Database\Seeders;

use App\Models\Companie;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Companie::factory()->create();
        Employee::factory()->create();
        User::factory()->create();
    }
}
