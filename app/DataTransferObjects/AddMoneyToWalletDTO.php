<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Api\V1\Wallet\AddMoneyRequest;

readonly class AddMoneyToWalletDTO
{
    public function __construct(
        private int $userId,
        private int $amount
    ) {

    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public static function fromApiRequest(AddMoneyRequest $request): self
    {
        return new self(userId: $request->validated('user_id'), amount: $request->validated('amount'));
    }
}
