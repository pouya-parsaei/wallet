<?php

namespace App\Models;

use App\Enums\Transaction\TransactionType;
use App\Models\Traits\Relations\TransactionRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory,
        TransactionRelationsTrait;

    protected $fillable = [
        'wallet_id', 'reference_id', 'type', 'amount',
    ];

    protected $casts = [
        'type' => TransactionType::class,
    ];
}
