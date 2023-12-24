<?php

namespace App\Enums\Transaction;

enum TransactionType: int
{
    case Deposit = 1;
    case Withdraw = 2;

    public function text(): string
    {
        return match ($this) {
            self::Deposit => 'deposit',
            self::Withdraw => 'withdraw'
        };
    }
}
