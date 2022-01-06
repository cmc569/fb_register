<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function createUser(string $name, string $email, string $password): bool {
        $id = User::insertGetId([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);
        return $id != 0;
    }

    public function isUserExist(string $email): bool {
        $count =  User::where('email', $email)
            ->orderBy('id')
            ->count();
        return $count > 0;
    }

}
