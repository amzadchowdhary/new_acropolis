<?php

namespace Tests\Feature\Auth;

use App\Models\Branch;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $branch = Branch::factory()->create();

        $response = $this->post('/register', [
            'name' => 'Testing',
            'email' => 'test@gmail.com',
            'phone' => '7897664332',
            'address' => 'Jammu',
            'country' => 'India',
            'state' => 'state',
            'city' => 'city',
            'pin_code' => '123456',
            'branch' => $branch['id'],
            'role' =>'Admin',
            'email_verified_at' => now(),
            'password' => 'password', // password
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

    }
}
