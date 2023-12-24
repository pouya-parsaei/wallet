<?php

namespace Tests\Feature\Api\V1\WalletController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\Contracts\Makers\WalletMaker;
use Tests\TestCase;

class WalletGetBalanceTest extends TestCase
{
    use WalletMaker;

    private string $routeName = 'api.v1.wallets.get-balance';

    public function test_get_wallet_balance_returns_success_status_code(): void
    {
        $userId = 1;
        $this->createWallet(['user_id' => $userId]);

        $response = $this->getJson(route($this->routeName, ['user_id' => $userId]));

        $response->assertSuccessful();
    }

    public function test_get_wallet_balance_returns_correct_json_structure(): void
    {
        $userId = 1;
        $this->createWallet(['user_id' => $userId]);

        $response = $this->getJson(route($this->routeName, ['user_id' => $userId]));

        $response->assertJsonStructure([
            'balance'
        ]);
    }

    public function test_get_wallet_balance_returns_correct_balance(): void
    {
        $userId = 1;
        $wallet = $this->createWallet(['user_id' => $userId]);

        $response = $this->getJson(route($this->routeName, ['user_id' => $userId]));

        $response->assertJsonFragment([
            'balance' => $wallet->balance
        ]);
    }

    public function test_get_wallet_balance_returns_error_when_user_id_is_invalid(): void
    {
        $userId = 1;
        $this->createWallet(['user_id' => $userId]);
        $invalidUserId = 999;

        $response = $this->getJson(route($this->routeName, ['user_id' => $invalidUserId]));

        $response->assertNotFound()->assertJsonFragment(['message' => trans('messages.wallet_not_found_due_to_mismatch_user_id')]);
    }

    public function test_get_wallet_balance_returns_negative_balance_when_wallet_balance_is_negative(): void
    {
        $userId = 1;
        $negativeBalance = -999;
        $this->createWallet(['user_id' => $userId, 'balance' => $negativeBalance]);

        $response = $this->getJson(route($this->routeName, ['user_id' => $userId]));

        $response->assertJsonFragment([
            'balance' => $negativeBalance
        ]);
    }
}
