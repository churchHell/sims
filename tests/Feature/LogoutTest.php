<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Auth\Logout;
use Livewire;

class LogoutTest extends BaseTest
{
    
    use RefreshDatabase;

    public function test_user_can_logout()
    {
        $this->actingAs($user = $this->createUser());
        $this->assertAuthenticatedAs($user);
        $response = Livewire::test(Logout::class)
            ->call('logout');
        $this->assertGUest();
    }

}
