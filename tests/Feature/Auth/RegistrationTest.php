<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_can_be_accessed_thro_api()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Sally',
            'email' => 'Sally@test.com',
            'password' => "password",
            'password_confirmation' => "password",
        ]);

        $response->assertStatus(201);
            // ->assertJson([
                // 'created' => true,

            // ]);
        // $response->assertStatus(200);
    }

    // public function test_new_users_can_register()
    // {
    //     $response = $this->post('/register', [
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);

    //     $this->assertAuthenticated();
    //     // $response->assertRedirect(RouteServiceProvider::HOME);
    // }
}
