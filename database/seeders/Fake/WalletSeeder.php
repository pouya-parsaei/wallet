<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                Wallet::factory()->for($user)->create();
            }

            return;
        }

        Wallet::factory(random_int(1, 10))->create();
    }
}
