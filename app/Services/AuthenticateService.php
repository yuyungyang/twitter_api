<?php

namespace App\Services;

use App\Repositories\UsersRepository;

class AuthenticateService
{
    protected $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
    }

    public function login()
    {
        //
    }
}