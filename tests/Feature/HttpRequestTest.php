<?php

namespace Tests\Feature;

use App\Services\Token;
use App\Services\UserFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class HttpRequestTest extends TestCase
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
        $this->password = $this->faker->password;
    }

    public function test_login()
    {
        $this->instance(UserFile::class, $this->file);
        $this->file->appendUser($this->email, hash('sha256', $this->password));

        $response = $this->post('/api/user/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $response->assertStatus(200);
        $response->assertJson( function (AssertableJson $json) {
            $json->whereType('token', 'string');
        });
    }

    public function test_create_user()
    {
        $this->instance(UserFile::class, $this->file);

        $response = $this->post('api/user/create', [
           'email' => $this->email,
           'password' => $this->password
        ]);

        $response->assertStatus(200);
        $this->fileSystem->assertExists(UserFile::PATH);
        $this->assertTrue($this->file->userExists($this->email));
    }

    public function test_get_btc_rate()
    {
        $token = (new Token())->setToken($this->email);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])
            ->get('/api/btcRate');

        $response->assertStatus(200);
        $response->assertJson( function (AssertableJson $json) {
            $json->whereType('rate', 'double');
        });
    }
}
