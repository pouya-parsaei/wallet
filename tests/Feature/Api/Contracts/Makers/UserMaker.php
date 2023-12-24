<?php

namespace Tests\Feature\Api\Contracts\Makers;

use App\Models\User;
use Illuminate\Support\Collection;

trait UserMaker
{
    public function createUser(?int $count = null, array $data = []): User|Collection
    {
        return User::factory($count)->create($data);
    }
}
