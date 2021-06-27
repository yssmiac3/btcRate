<?php


namespace App\Models;

use Redis;

class CustomUser
{
    public function __construct()
    {
        // check if data is okay with DTO?
        $this->email = 'email';
        $this->password = 'password';
    }

    public function exist($params)
    {
        $file = 'some file';
        $email = $params['email'];
        // parse this file and find if user with this username already exits
    }

    public function create($params)
    {
        if ($this->exist())
        {
            return false;
        }

        $email = $params['email'];
        $password = crypt($params['password']);
    }

    public function checkPassword()
    {
        if (!$this->exist()) {
            return false;
        }

        $file = 'some file';

        foreach ($file /* read lines */ as $key => $value) {
            if ($value) {
                return $value == crypt($this->password);
            }
        }

        return false;
    }

    public function isAuthenticated($token, $email)
    {
        return Redis::get($email) == $token;
    }
}
