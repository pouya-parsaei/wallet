<?php

namespace App\Models\Traits\Relations;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait WalletRelationsTrait
{
    public function transactions():HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
