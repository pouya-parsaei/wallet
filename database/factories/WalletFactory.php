<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 100),
            'balance' => random_int(-200, 200)
        ];
    }
}
