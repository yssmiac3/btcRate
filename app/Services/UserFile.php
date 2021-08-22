<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;

class UserFile
{
    const PATH = 'users.txt';

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function checkCredentials(string $email, string $password)
    {
        $string = $this->fileSystem->get(static::PATH);

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $string) as $line){
            if (explode(';', trim($line)) == array($email, $password)) {
                return true;
            }
        }

        return false;
    }

    public function appendUser(string $email, string $password)
    {
        $data = $email . ';' . $password;
        $this->fileSystem->append(static::PATH, $data);

        return true;
    }

    public function userExists(string $email)
    {
        $string = $this->fileSystem->get(static::PATH);

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $string) as $line){
            if (explode(';', trim($line))[0] == $email) {
                return true;
            }
        }

        return false;
    }
}
