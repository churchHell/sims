<?php

namespace App\Providers;

use App\Models\Group;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('parts.groups-list', function($view){
            $view->with(['groups' => (new Group)->actual()->get()->keyBy('id')]);
        });

        // view()->composer('parts.group-info', function($view){
        //     $view->with(['group' => Group::findOrFail($view->getData()['group'])]);
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
