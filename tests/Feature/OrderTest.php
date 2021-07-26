<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Livewire;
use App\Http\Livewire\Orders\{Users as UsersLivewire, Search as SearchLivewire};
use App\Models\{Group, Order, User, Pivots\OrderUser};
use App\Repositories\DeliveryRepository;
use Illuminate\Foundation\Testing\WithFaker;

class OrderTest extends BaseTest
{

    use DatabaseMigrations, WithFaker;

    private Group $group;
    private User $user;
    private User $anotherUser;
    private User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser(1);
        $this->anotherUser = $this->createUser(1);
        $this->admin = $this->createUser(2);
        $this->group = Group::factory()->create(['created_user_id' => $this->user->id]);

        $repository = Mockery::mock(DeliveryRepository::class);
        $repository->shouldReceive('getPrice')->andReturn(collect(['cost' => 5]));
        $this->app->instance(DeliveryRepository::class, $repository);
    }

    public function test_order_actions(): void
    {
        // Store not active user
        $response = $this->storeQuery($this->createUser(1, 0));
        $this->assertEquals(Order::count(), 0);
        $this->assertEquals(OrderUser::count(), 0);
        $response->assertStatus(403);

        // Store order
        $response = $this->storeQuery($this->user);
        $this->assertEquals(Order::count(), 1);
        $this->assertEquals(($order = Order::first())->users->first()->id, $this->user->id);
        $this->assertEquals($order->users->count(), 1);
        $this->assertEquals($order->users->first()->pivot->qty, 1);

        // Update self order
        $response = $this->updateQuery($order, 2, $this->user);
        $this->assertEquals(Order::first()->userPivot($this->user)->qty, 2);

        // Join order
        $response = $this->joinQuery($order);
        $this->assertEquals(Order::count(), 1);
        $this->assertEquals(($order = Order::first())->users->last()->id, $this->anotherUser->id);
        $this->assertEquals($order->users->count(), 2);
        $this->assertEquals($order->users->last()->pivot->qty, 5);

        // Update another order
        $response = $this->updateQuery($order, 6, $this->user, $this->anotherUser);
        $this->assertEquals(Order::first()->userPivot($this->anotherUser)->qty, 5);
        $response->assertStatus(403);

        // Update admin order
        $response = $this->updateQuery($order, 1, $this->admin, $this->user);
        $this->assertEquals(Order::first()->userPivot($this->user)->qty, 1);

        // Destroy another order
        $response = $this->destroyQuery($order, $this->user, $this->anotherUser);
        $this->assertEquals(Order::count(), 1);
        $this->assertEquals(OrderUser::count(), 2);
        $response->assertStatus(403);

        // Destroy admin order
        $response = $this->destroyQuery($order, $this->admin, $this->anotherUser);
        $this->assertEquals(Order::count(), 1);
        $this->assertEquals(OrderUser::count(), 1);

        // Destroy self single order
        $response = $this->destroyQuery($order, $this->user);
        $this->assertEquals(Order::count(), 0);
        $this->assertEquals(OrderUser::count(), 0);
    }

    private function storeQuery(User $user)
    {
        $this->actingAs($user);
        $order = Order::factory()->make()->toArray();

        return Livewire::test(SearchLivewire::class, [
            'qtys' => [$order['sid'] => 1],
            'groupId' => $this->group->id,
            'items' => [$order['sid'] => $order],
            'sid' => $order['sid']
        ])->call('store', $order['sid']);
    }

    private function updateQuery(Order $order, int $qty, User $actingUser, User $targetUser = null)
    {
        $this->actingAs($actingUser);
        $targetUser = $targetUser ?? $actingUser;

        return Livewire::test(UsersLivewire::class, [
            'pivotIdToUpdate' => $order->userPivot($targetUser)->id,
            'order' => $order
        ])->set('qtys.' . $order->userPivot($targetUser)->id, $qty)->call('update');
    }

    private function joinQuery(Order $order)
    {
        $this->actingAs($this->anotherUser);

        return Livewire::test(UsersLivewire::class, [
            'qty' => 5,
            'order' => $order
        ])->call('store');
    }

    private function destroyQuery(Order $order, User $actingUser, User $targetUser = null)
    {
        $this->actingAs($actingUser);
        $targetUser = $targetUser ?? $actingUser;

        return Livewire::test(UsersLivewire::class, [
            'pivotIdToUpdate' => $order->userPivot($targetUser)->id,
            'order' => $order
        ])->call('destroy');
    }
}
