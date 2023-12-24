<?php

namespace App\Models;

use App\Models\Traits\Relations\UserRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory,UserRelationsTrait;
}
