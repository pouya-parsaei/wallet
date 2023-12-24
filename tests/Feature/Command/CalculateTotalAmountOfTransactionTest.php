<?php

namespace Tests\Feature\Command;

use App\Enums\Transaction\TransactionType;
use App\Models\Transaction;
use Tests\TestCase;

class CalculateTotalAmountOfTransactionTest extends TestCase
{
    public function test_calculate_total_amount_of_transaction_command(): void
    {
        Transaction::factory()->create([
            'amount' => 100,
            'type' => TransactionType::Deposit,
        ]);
        Transaction::factory()->create([
            'amount' => 100,
            'type' => TransactionType::Withdraw,
        ]);

        $this
            ->artisan('transactions:total-amount')
            ->assertSuccessful()
            ->expectsOutput('total amount of transactions: 200');
    }
}
