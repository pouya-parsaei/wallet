<?php

use App\Http\Controllers\Api\V1\WalletController;
use Illuminate\Support\Facades\Route;

Route::controller(WalletController::class)
    ->prefix('wallets')
    ->name('wallets.')
    ->group(function () {
        Route::get('get-balance', 'getBalance')->name('get-balance');
        Route::post('add-money', 'addMoney')->name('add-money');
    });
