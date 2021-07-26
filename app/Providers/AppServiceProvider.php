<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\{Group, Order, User, Pivots\OrderUser};
use App\Observers\{GroupObserver, OrderObserver, UserObserver, Pivots\OrderUserObserver};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\DeliveryRepositoryContract',
            'App\Repositories\DeliveryRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ItemRepositoryContract',
            'App\Repositories\ItemRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\CartRepositoryContract',
            'App\Repositories\CartRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Group::observe(GroupObserver::class);
        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
        OrderUser::observe(OrderUserObserver::class);
    }
}
