<?php

namespace App\DataTransferObjects;

readonly class AddMoneyToWalletDTO
{
    public function __construct(
        private int $userId,
        private int $amount
    ) {

    }
}
