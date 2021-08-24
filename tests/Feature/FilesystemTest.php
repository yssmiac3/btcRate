<?php

namespace Tests\Feature;

use App\Services\UserFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FilesystemTest extends TestCase
{
    use WithFaker;

    const STORAGE_NAME = 'testUser';

    private $fileSystem;
    private $file;
    private $email;
    private $password;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fileSystem = Storage::fake(self::STORAGE_NAME);
        $this->file = new UserFile($this->fileSystem);
        $this->email = $this->faker->email;
        $this->password = $this->faker->sha256;
    }

    public function test_user_creation_in_storage()
    {
        $this->file->appendUser($this->email, $this->password);
        $this->fileSystem->assertExists(UserFile::PATH);
    }

    public function test_user_existence_in_storage()
    {
        $this->file->appendUser($this->email, $this->password);
        $this->assertTrue($this->file->userExists($this->email));
    }

    public function test_user_credentials_check()
    {
        $this->file->appendUser($this->email, $this->password);
        $this->assertTrue($this->file->checkCredentials($this->email, $this->password));
    }
}
