<?php

namespace Tests\Feature;

use App\Services\Token;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use WithFaker;

    private $email;
    private $tokenService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->email = $this->faker->email;
        $this->tokenService = new Token();
    }

    public function test_set_token()
    {
        $token = $this->tokenService->setToken($this->email);

        $this->assertIsString($token);
        $this->assertTrue($this->tokenService->checkByToken($token));
        $this->assertTrue($this->tokenService->checkByEmail($this->email));
    }
}
