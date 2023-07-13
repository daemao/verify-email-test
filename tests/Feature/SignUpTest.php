<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_sign_up_success(): void
    {
        $fakeUser = User::factory()->unverified()->withPassword('testing_password')->makeOne();
        $userForm = $fakeUser->only(['email','password']);
        $response = $this->post('/api/v1/auth/sign-up',$userForm);

        $response->assertStatus(201);
    }
}
