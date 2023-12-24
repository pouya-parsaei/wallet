<?php

namespace Database\Seeders\Fake;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory(random_int(10, 30))->create();
    }
}
