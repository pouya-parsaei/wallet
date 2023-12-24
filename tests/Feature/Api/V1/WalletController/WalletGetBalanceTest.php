<?php

namespace Tests\Feature\Api\V1\WalletController;

use Tests\Feature\Api\Contracts\Makers\UserMaker;
use Tests\Feature\Api\Contracts\Makers\WalletMaker;
use Tests\TestCase;

class WalletGetBalanceTest extends TestCase
{
    use UserMaker,
        WalletMaker;

    private string $routeName = 'api.v1.wallets.get-balance';

    public function test_get_wallet_balance_returns_success_status_code(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);

        $response = $this->getJson(route($this->routeName, ['user_id' => $user->id]));

        $response->assertSuccessful();
    }

    public function test_get_wallet_balance_returns_correct_json_structure(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);

        $response = $this->getJson(route($this->routeName, ['user_id' => $user->id]));

        $response->assertJsonStructure([
            'balance',
        ]);
    }

    public function test_get_wallet_balance_returns_correct_balance(): void
    {
        $user = $this->createUser();
        $wallet = $this->createWalletFor($user);

        $response = $this->getJson(route($this->routeName, ['user_id' => $user->id]));

        $response->assertJsonFragment([
            'balance' => $wallet->balance,
        ]);
    }

    public function test_get_wallet_balance_returns_error_when_user_id_is_invalid(): void
    {
        $invalidUserId = 999;

        $response = $this->getJson(route($this->routeName, ['user_id' => $invalidUserId]));

        $response->assertInvalid(['user_id' => trans('validation.exists', ['attribute' => 'user id'])]);
    }

    public function test_get_wallet_balance_returns_negative_balance_when_wallet_balance_is_negative(): void
    {
        $negativeBalance = -999;
        $user = $this->createUser();
        $this->createWalletFor($user, ['balance' => $negativeBalance]);

        $response = $this->getJson(route($this->routeName, ['user_id' => $user->id]));

        $response->assertJsonFragment([
            'balance' => $negativeBalance,
        ]);
    }

    public function test_get_wallet_balance_returns_error_when_user_does_not_have_wallet(): void
    {
        $user = $this->createUser();

        $response = $this->getJson(route($this->routeName, ['user_id' => $user->id]));

        $response->assertNotFound()->assertJsonFragment([
            'message' => trans('messages.user_does_not_have_wallet'),
        ]);

    }
}
