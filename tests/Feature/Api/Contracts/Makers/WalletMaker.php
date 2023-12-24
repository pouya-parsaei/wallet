<?php

namespace Tests\Feature\Api\Contracts\Makers;

use App\Models\User;
use App\Models\Wallet;

trait WalletMaker
{
    public function createWalletFor(User $user, array $data = []): Wallet
    {
        return Wallet::factory()->for($user)->create($data);
    }
}
