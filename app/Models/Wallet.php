<?php

namespace App\Models;

use App\Models\Traits\Relations\WalletRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory,
        WalletRelationsTrait;

    protected $fillable = [
        'balance',
    ];
}
