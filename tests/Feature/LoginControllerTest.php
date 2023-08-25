<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    public function it_can_show_the_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function it_can_authenticate_a_user()
    {

        $user = User::factory(1)->create()->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $response->assertRedirect(RouteServiceProvider::DASHBOARD);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_redirects_back_with_invalid_credentials()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function it_logs_out_a_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
