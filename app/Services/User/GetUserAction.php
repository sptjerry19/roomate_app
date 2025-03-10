<?php

namespace App\Services\User;

use App\Models\User;

class GetUserAction
{
    public function execute(string $email)
    {
        return User::where('email', $email)->firstOrFail();
    }
}