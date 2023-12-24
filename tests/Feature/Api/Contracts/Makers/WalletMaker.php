<?php

namespace Tests\Feature\Api\Contracts\Makers;

use App\Models\Wallet;

trait WalletMaker
{
    public function createWallet(array $data = []): Wallet
    {
        return Wallet::factory()->create($data);
    }
}
