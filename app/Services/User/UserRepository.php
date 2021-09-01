<?php

namespace App\Services\User;

interface UserRepository
{
    public function checkCredentials(string $email, string $password): bool;
    public function appendUser(string $email, string $password): bool;
    public function userExists(string $email): bool;
}
