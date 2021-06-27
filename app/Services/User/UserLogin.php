<?php


namespace App\Services\User;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Redis;

class UserLogin
{
    public function login($params)
    {
        $user = $params['user'];
        if ($user->checkPassword($params)) {
//            $token = \OAuthProvider::generateToken(16);
//            dd(bin2hex($token));
            $token = 'generate token';
            Redis::set($user->email, $token, 3600);
            return $token;
        }

        return false;
    }
}
