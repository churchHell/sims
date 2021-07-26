<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{IndexController, GroupsController, SearchController};
use App\Http\Livewire\{Accounts\Accounts, Archive\Archive, Auth\Account, Groups\Groups, Report\Report};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{group?}', [IndexController::class, 'index'])->name('index')->defaults('group', 1);

Route::group(['middleware' => ['auth', 'active']], function () {
    Route::get('/search/{group}', [SearchController::class, 'index'])->name('search.index');
    Route::get('/account', Account::class)->name('account');
    Route::get('/archive', Archive::class)->name('archive');
    Route::get('/report/{group}', Report::class)->name('report');
    Route::group(['middleware' => 'role:admin'], function () {
        // Route::get('groups', Groups::class)->name('groups');
        Route::get('groups', [GroupsController::class, 'index'])->name('groups');
    });
    Route::group(['middleware' => 'role:super'], function () {
        Route::get('accounts', Accounts::class)->name('accounts');
    });
});

Auth::routes();
