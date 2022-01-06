<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function register(String $name, String $email, String $password) {
        return $this->userRepository->createUser($name, $email, $password);
    }

    public function login(String $email, String $password)
    {
        return auth()->attempt(["email" => $email, "password" => $password]);
    }


    public function logout()
    {
        auth()->logout();
    }

}
