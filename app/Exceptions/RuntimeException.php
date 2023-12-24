<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RuntimeException extends Exception
{
    use ResponseHelper;

    public static function causeUserDoesNotHaveWallet(): self
    {
        return new self(trans('messages.user_does_not_have_wallet'));
    }

    public function render(Request $request): JsonResponse
    {
        return $this->respondError($this->getMessage(), Response::HTTP_NOT_FOUND);
    }
}
