<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\{Group, User};

class BaseTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('config:clear');
        $this->artisan('db:seed');
    }

    public function createUser(int $role_id = 1, int $active = 1): User
    {
        return User::factory()->create(compact('role_id', 'active'));
    }

    public function createGroup(): Group
    {
        return Group::factory()->create();
    }
}
