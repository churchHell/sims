<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Http\Livewire\Auth\Register;
use Livewire;

class RegisterTest extends BaseTest
{

    use RefreshDatabase;

    private $email = 'mail@mail.ru';

    public function test_user_can_see_register_page()
    {
        $response = $this->get(route('register'));
        $response->assertOk();
    }

    public function test_user_can_register()
    {
        $response = $this->registerQuery();
        $user = User::whereEmail($this->email)->first();
        $this->assertTrue($user->exists());
        $this->assertEquals($user->active, 0);
        $this->assertEquals($user->role_id, 1);
    }

    public function test_user_can_not_register_without_name()
    {
        $response = $this->registerQuery(['name' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_without_surname()
    {
        $response = $this->registerQuery(['surname' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_without_phone()
    {
        $response = $this->registerQuery(['phone' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_without_email()
    {
        $response = $this->registerQuery(['email' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_without_password()
    {
        $response = $this->registerQuery(['password' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_with_wrong_password_confirmation()
    {
        $response = $this->registerQuery(['password_confirmation' => '']);
        $this->assertFalse(User::whereEmail($this->email)->exists());
    }

    public function test_user_can_not_register_with_exists_email()
    {
        $this->registerQuery();
        $this->assertTrue(User::whereEmail($this->email)->exists());
        $this->registerQuery()->assertHasErrors(['email' => 'unique']);
        $this->assertTrue(User::whereEmail($this->email)->count() == 1);
    }

    public function registerQuery(array $data = [])
    {
        $default = [
            'name' => 'name',
            'surname' => 'surname',
            'phone' => '123456789',
            'email' => $this->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = Livewire::test(Register::class, array_merge($default, $data))
            ->call('store');
        return $response;
    }
}
