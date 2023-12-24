<?php

namespace Tests\Feature\Api\V1\WalletController;

use App\Models\Transaction;
use Tests\Feature\Api\Contracts\Makers\UserMaker;
use Tests\Feature\Api\Contracts\Makers\WalletMaker;
use Tests\TestCase;

class WalletAddMoneyTest extends TestCase
{
    use UserMaker, WalletMaker;

    private string $routeName = 'api.v1.wallets.add-money';

    public function test_add_money_to_wallet_returns_success_status_code(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);

        $response = $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => 100]));

        $response->assertCreated();
    }

    public function test_add_money_to_wallet_returns_correct_json_structure(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);

        $response = $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => 100]));

        $response->assertJsonStructure([
            'reference_id',
        ]);
    }

    public function test_add_money_to_wallet_returns_correct_data(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);

        $response = $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => 100]));

        $transaction = Transaction::first();
        $response->assertJsonFragment([
            'reference_id' => $transaction->reference_id,
        ]);
    }

    public function test_add_money_to_wallet_inserts_data_correctly_into_database_when_amount_is_positive(): void
    {
        $user = $this->createUser();
        $wallet = $this->createWalletFor($user);
        $amount = 100;

        $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => $amount]));

        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseHas('transactions', [
            'wallet_id' => $wallet->id,
            'amount' => $amount,
        ]);

        $expectedWalletBalance = $wallet->balance + $amount;
        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'balance' => $expectedWalletBalance,
        ]);
    }

    public function test_add_money_to_wallet_inserts_data_correctly_into_database_when_amount_is_negative(): void
    {
        $user = $this->createUser();
        $wallet = $this->createWalletFor($user);
        $amount = -100;

        $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => $amount]));

        $this->assertDatabaseCount('transactions', 1);
        $this->assertDatabaseHas('transactions', [
            'wallet_id' => $wallet->id,
            'amount' => $amount,
        ]);

        $expectedWalletBalance = $wallet->balance + $amount;
        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'balance' => $expectedWalletBalance,
        ]);
    }

    public function test_add_money_to_wallet_returns_error_when_amount_is_zero(): void
    {
        $user = $this->createUser();
        $this->createWalletFor($user);
        $amount = 0;

        $response = $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => $amount]));

        $response
            ->assertForbidden()
            ->assertJsonFragment(['message' => trans('messages.amount_could_not_be_zero')]);
    }

    public function test_add_money_to_wallet_returns_error_when_user_id_is_invalid(): void
    {
        $invalidUserId = 999;

        $response = $this->postJson(route($this->routeName, ['user_id' => $invalidUserId, 'amount' => 100]));

        $response->assertInvalid(['user_id' => trans('validation.exists', ['attribute' => 'user id'])]);
    }

    public function test_add_money_to_wallet_returns_error_when_user_does_not_have_wallet(): void
    {
        $user = $this->createUser();

        $response = $this->postJson(route($this->routeName, ['user_id' => $user->id, 'amount' => 100]));

        $response->assertNotFound()->assertJsonFragment([
            'message' => trans('messages.user_does_not_have_wallet'),
        ]);
    }
}
