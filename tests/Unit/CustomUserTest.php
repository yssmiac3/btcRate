<?php

namespace Tests\Unit;

use App\Models\CustomUser;
use App\Services\UserFile;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomUserTest extends TestCase
{
    use  WithFaker;

    private $email;
    private $password;
    private $customUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->email = $this->faker->email;
        $this->password = $this->faker->password;
    }

    public function test_email_exists()
    {
        $mock = \Mockery::mock(UserFile::class);

        $mock->shouldReceive('userExists')
            ->once()
            ->withArgs([$this->email])
            ->andReturnFalse();

        $this->instance(UserFile::class, $mock);

        $customUser = new CustomUser($this->email, $this->password);

        $this->assertFalse($customUser->emailExist());
    }

    public function test_save()
    {
        $mock = \Mockery::mock(UserFile::class);

        $mock->shouldReceive('userExists')
            ->once()
            ->withArgs([$this->email])
            ->andReturnFalse();

        $mock->shouldReceive('appendUser')
            ->once()
            ->withArgs([$this->email, hash('sha256', $this->password)])
            ->andReturnTrue();

        $this->instance(UserFile::class, $mock);

        $customUser = new CustomUser($this->email, $this->password);

        $this->assertTrue($customUser->save());
    }

    public function test_check_existing_credentials()
    {
        $mock = \Mockery::mock(UserFile::class);

        $mock->shouldReceive('checkCredentials')
            ->once()
            ->withArgs([$this->email, hash('sha256', $this->password)])
            ->andReturnFalse();

        $this->instance(UserFile::class, $mock);

        $customUser = new CustomUser($this->email, $this->password);

        $this->assertFalse($customUser->checkExistingCredentials());
    }
}
