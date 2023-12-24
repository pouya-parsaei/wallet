<?php

namespace App\Services;

use App\Enums\Transaction\TransactionType;
use App\Models\Transaction;

class TransactionService
{
    public function saveTransaction(int $walletId, int $amount): Transaction
    {
        return Transaction::create([
            'wallet_id' => $walletId,
            'amount' => $amount,
            'reference_id' => abs(crc32(uniqid())),
            'type' => $amount < 0 ? TransactionType::Withdraw : TransactionType::Deposit,
        ]);
    }
}
