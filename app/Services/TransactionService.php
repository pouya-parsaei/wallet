<?php

namespace App\Services;

use App\Enums\Transaction\TransactionType;
use App\Helpers\ReferenceMaker;
use App\Models\Transaction;

class TransactionService
{
    public function saveTransaction(int $walletId, int $amount): Transaction
    {
        return Transaction::create([
            'wallet_id' => $walletId,
            'amount' => abs($amount),
            'reference_id' => ReferenceMaker::makeNumericReferenceId(),
            'type' => $amount < 0 ? TransactionType::Withdraw : TransactionType::Deposit,
        ]);
    }
}
