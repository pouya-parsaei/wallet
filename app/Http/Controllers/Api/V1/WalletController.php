<?php

namespace App\Http\Controllers\Api\V1;

use App\DataTransferObjects\AddMoneyToWalletDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wallet\AddMoneyRequest;
use App\Http\Requests\Api\V1\Wallet\GetBalanceRequest;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    public function __construct(private WalletService $walletService)
    {

    }

    public function getBalance(GetBalanceRequest $request): JsonResponse
    {
        $balance = $this
            ->walletService
            ->getUserWalletBalance($request->validated('user_id'));

        return response()->json([
            'balance' => $balance,
        ]);
    }

    public function addMoney(AddMoneyRequest $request): JsonResponse
    {
        $referenceId = $this
            ->walletService
            ->addMoneyToUserWallet(AddMoneyToWalletDTO::fromApiRequest($request));

        return response()->json([
            'reference_id' => $referenceId,
        ], Response::HTTP_CREATED);
    }
}
