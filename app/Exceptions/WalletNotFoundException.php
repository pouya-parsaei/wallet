<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WalletNotFoundException extends Exception
{
    use ResponseHelper;

    public static function causeOfInvalidUserId(): self
    {
        return new self(trans('messages.wallet_not_found_due_to_mismatch_user_id'));
    }

    public function render(Request $request): JsonResponse
    {
        return $this->respondError($this->getMessage(),Response::HTTP_NOT_FOUND);
    }
}
