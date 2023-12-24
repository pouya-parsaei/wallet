<?php

namespace App\Services;

use App\Exceptions\InvalidArgumentException;
use App\Exceptions\RuntimeException;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function __construct(private TransactionService $transactionService)
    {

    }

    public function getUserWalletBalance(int $userId): int
    {
        return $this
            ->findUserWallet($userId)
            ->balance;
    }

    /**
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    private function findUserWallet(int $userId): Wallet
    {
        $user = User::find($userId);
        if (! $user) {
            throw InvalidArgumentException::causeOfInvalidUserId();
        }

        $wallet = Wallet::whereUserId($userId)->first();
        if (! $wallet) {
            throw RuntimeException::causeUserDoesNotHaveWallet();
        }

        return $wallet;
    }

    public function addMoneyToUserWallet(int $userId, int $amount): int
    {
        $this->checkIfAmountIsValid($amount);

        return Cache::lock('user_'.$userId)->block(3, function () use ($userId, $amount) {
            $wallet = $this->findUserWallet($userId);

            return DB::transaction(function () use ($wallet, $amount) {

                $this->updateWalletBalance($wallet, $amount);

                $transaction = $this->transactionService->saveTransaction($wallet->id, $amount);

                return $transaction->reference_id;
            });

        });
    }

    /**
     * @throws InvalidArgumentException
     */
    private function checkIfAmountIsValid(int $amount): void
    {
        if ($amount === 0) {
            throw InvalidArgumentException::causeAmountIsZero();
        }
    }

    private function updateWalletBalance(Wallet $wallet, int $amount): void
    {
        $wallet->update([
            'balance' => $wallet->balance + $amount,
        ]);
    }
}
