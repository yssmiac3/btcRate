<?php

namespace App\Services\User;

use Illuminate\Contracts\Filesystem\Filesystem;

class UserFile implements UserRepository
{
    const PATH = 'users.txt';

    private $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function checkCredentials(string $email, string $password): bool
    {
        if (! $this->fileSystem->exists(static::PATH)) {
            return false;
        }

        $string = $this->fileSystem->get(static::PATH);

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $string) as $line){
            if (explode(';', trim($line)) == array($email, $password)) {
                return true;
            }
        }

        return false;
    }

    public function appendUser(string $email, string $password): bool
    {
        $data = $email . ';' . $password;
        $this->fileSystem->append(static::PATH, $data);

        return true;
    }

    public function userExists(string $email): bool
    {
        if (! $this->fileSystem->exists(static::PATH)) {
            return false;
        }

        $string = $this->fileSystem->get(static::PATH);

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $string) as $line){
            if (explode(';', trim($line))[0] == $email) {
                return true;
            }
        }

        return false;
    }
}
