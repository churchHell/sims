<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Livewire;
use App\Http\Livewire\Groups\{Group, Groups};
use App\Models\{Group as Model, User};

class GroupsTest extends BaseTest
{
    use DatabaseMigrations;

    // See

    public function test_user_can_not_see_groups_page()
    {
        $response = $this->actingAs($this->createUser())->get(route('groups'));
        $response->assertStatus(401);
    }

    public function test_admin_can_see_groups_page()
    {
        $response = $this->actingAs($this->createUser(2))->get(route('groups'));
        $response->assertOk();
    }

    public function test_not_active_admin_can_not_see_groups_page()
    {
        $response = $this->actingAs($this->createUser(2, 0))->get(route('groups'));
        $response->assertStatus(499);
    }

    // Store

    public function test_not_active_admin_can_not_store_group()
    {
        $response = $this->storeQuery($this->createUser(2, 0));
        $this->assertEquals(Model::count(), 0);
        $response->assertStatus(403);
    }

    public function test_user_can_not_store_group()
    {
        $response = $this->storeQuery($this->createUser());
        $this->assertEquals(Model::count(), 0);
        $response->assertStatus(403);
    }

    public function test_admin_can_store_group()
    {
        $response = $this->storeQuery($user = $this->createUser(2));
        $this->assertEquals(Model::count(), 1);
        $this->assertEquals(Model::first()->created_user_id, $user->id);
    }

    // Destroy

    public function test_admin_can_destroy_group()
    {
        $response = $this->destroyQuery($user = $this->createUser(2), $group = $this->createGroup());
        $this->assertEquals(Model::count(), 0);
    }

    public function test_not_active_admin_can_not_destroy_group()
    {
        $response = $this->destroyQuery($user = $this->createUser(2, 0), $group = $this->createGroup());
        $this->assertEquals(Model::count(), 1);
    }

    public function test_user_can_not_destroy_group()
    {
        $response = $this->destroyQuery($user = $this->createUser(1), $group = $this->createGroup());
        $this->assertEquals(Model::count(), 1);
    }

    // Update

    public function test_admin_can_update_group()
    {
        $response = $this->updateQuery($user = $this->createUser(2), $group = $this->createGroup());
        $this->assertEquals(Model::findOrFail($group->id)->comment, 'comment');
    }

    public function test_not_active_admin_can_not_update_group()
    {
        $response = $this->updateQuery($user = $this->createUser(2, 0), $group = $this->createGroup());
        $this->assertEquals(Model::findOrFail($group->id)->comment, null);
    }

    public function test_user_can_not_update_group()
    {
        $response = $this->updateQuery($user = $this->createUser(1), $group = $this->createGroup());
        $this->assertEquals(Model::findOrFail($group->id)->comment, null);
    }

    private function storeQuery(User $user)
    {
        $this->actingAs($user);
        return Livewire::test(Groups::class)->call('store');
    }

    private function destroyQuery(User $user, Model $group)
    {
        $this->actingAs($user);
        return Livewire::test(Group::class, compact('group'))->call('destroy');
    }

    private function updateQuery(User $user, Model $group)
    {
        $this->actingAs($user);
        $comment = 'comment';
        return Livewire::test(Group::class, [$group])->set('comment', $comment)->assertSet('comment', $comment)->call('update');
    }
}
