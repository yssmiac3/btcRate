<?php

namespace Tests\Unit;

use App\Services\Token;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use WithFaker;

    private $email;
    private $token;
    private $tokenService;
    private $redis;

    protected function setUp(): void
    {
        parent::setUp();
        $this->email = $this->faker->email;
        $this->tokenService = new Token();
    }

    public function test_set_token()
    {
        Redis::shouldReceive('keys')
            ->once()
            ->andReturnFalse();

        Redis::shouldReceive('set')
            ->once();

        Redis::shouldReceive('expire')
            ->once();

        $token = $this->tokenService->setToken($this->email);
        $this->assertIsString($token);

        Redis::shouldReceive('keys')
            ->once()
            ->with('tokens:*:' . $token)
            ->andReturnTrue();

        $this->assertTrue($this->tokenService->checkByToken($token));

        Redis::shouldReceive('keys')
            ->once()
            ->with('tokens:' . $this->email . '*')
            ->andReturnTrue();

        $this->assertTrue($this->tokenService->checkByEmail($this->email));

        $this->tearDown();
    }
}
