<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvalidArgumentException extends Exception
{
    use ResponseHelper;

    public static function causeAmountIsZero(): self
    {
        return new self(trans('messages.amount_could_not_be_zero'));
    }

    public static function causeOfInvalidUserId(): self
    {
        return new self(trans('messages.invalid_user_id'));
    }

    public function render(Request $request): JsonResponse
    {
        return $this->respondError($this->getMessage(), Response::HTTP_FORBIDDEN);
    }
}
