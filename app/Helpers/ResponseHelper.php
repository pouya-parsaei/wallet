<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseHelper
{
    public function respondError(string $message = '', $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $responseData = [
            'message' => $message,
        ];

        return response()->json($responseData, $status);
    }
}
