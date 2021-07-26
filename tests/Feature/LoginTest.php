<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Http\Livewire\Auth\Login;
use Livewire;
use Hash;

class LoginTest extends BaseTest
{

    use RefreshDatabase;

    private $email = 'mail@mail.ru';
    private $password = 'password';

    public function test_user_can_see_login_page()
    {
        $response = $this->get(route('login'));
        $response->assertOk();
    }

    public function test_user_can_login()
    {
        $user = $this->registerUser();
        $response = $this->loginQuery();
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_not_login_without_email()
    {
        $user = $this->registerUser();
        $response = $this->loginQuery(['email' => ''])->assertHasErrors(['email' => 'required']);
        $this->assertGuest();
    }

    public function test_user_can_not_login_without_password()
    {
        $user = $this->registerUser();
        $response = $this->loginQuery(['password' => ''])->assertHasErrors(['password' => 'required']);
        $this->assertGuest();
    }

    public function test_user_can_not_login_with_wrong_email()
    {
        $user = $this->registerUser();
        $response = $this->loginQuery(['email' => $this->email . '1']);
        $this->assertGuest();
    }

    public function test_user_can_not_login_with_wrong_password()
    {
        $user = $this->registerUser();
        $response = $this->loginQuery(['password' => $this->password . '1']);
        $this->assertGuest();
    }

    private function registerUser(array $data = [])
    {
        return User::factory()->create(['role_id' => 1, 'active' => 1, 'email' => $this->email, 'password' => Hash::make($this->password)]);
        // return $this->createUser(['email' => $this->email, 'password' => Hash::make($this->password)]);
    }

    private function loginQuery(array $data = [])
    {
        $default = [
            'email' => $this->email,
            'password' => $this->password
        ];
        $response = Livewire::test(Login::class, array_merge($default, $data))
            ->call('login');
        return $response;
    }
}
