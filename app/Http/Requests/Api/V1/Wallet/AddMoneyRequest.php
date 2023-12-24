<?php

namespace App\Http\Requests\Api\V1\Wallet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddMoneyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'amount' => ['required', 'integer', 'min:-999999999999', 'max:999999999999'],
        ];
    }
}
