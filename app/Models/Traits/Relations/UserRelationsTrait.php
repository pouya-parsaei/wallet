<?php

namespace App\Models\Traits\Relations;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserRelationsTrait
{
    public function wallet(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
