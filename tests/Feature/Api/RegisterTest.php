<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error create new Client
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'luis',
            'email' => 'luis@luis.com'
        ];

        $response = $this->postJson('api/v1/auth/register', $payload);

        $response->assertStatus(422);
//            ->assertExactJson([
//                'message' => 'The given data was invalid.',
//                'errors' => [
//                    'password' => [trans('validation.required', ['attribute' => 'password'])]
//                ]
//            ]);
    }

    /**
     * Success create new Client
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {
        $payload = [
            'name' => 'luis',
            'email' => 'luis@luis.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/v1/auth/register', $payload);

        $response->assertStatus(201)
            ->assertExactJson([
                'data' => [
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                ]
            ]);
    }
}
