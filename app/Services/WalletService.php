<?php

namespace App\Services;

use App\Exceptions\WalletNotFoundException;
use App\Models\Wallet;

class WalletService
{
    public function getUserWalletBalance(int $userId): int
    {
        $wallet = Wallet::whereUserId($userId)->first();

        if(is_null($wallet)){
            throw WalletNotFoundException::causeOfInvalidUserId();
        }

        return $wallet->balance;
    }
}
