<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email): ?Model;
}
