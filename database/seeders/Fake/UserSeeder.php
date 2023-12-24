<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(random_int(1, 10))->create();
    }
}
