<?php

namespace App\Models\Traits\Relations;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TransactionRelationsTrait
{
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
