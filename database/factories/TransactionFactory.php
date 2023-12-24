<?php

namespace Database\Factories;

use App\Enums\Transaction\TransactionType;
use App\Helpers\EnumHelper;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id' => Wallet::factory(),
            'amount' => random_int(100, 999999),
            'reference_id' => random_int(100, 999999),
            'type' => Arr::random(EnumHelper::getValuesAsArray(TransactionType::class)),
        ];
    }
}
