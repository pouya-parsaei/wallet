<?php

namespace App\Enums\Transaction;

enum TransactionType: int
{
    case Deposit = 1;
    case Withdraw = 2;
}
