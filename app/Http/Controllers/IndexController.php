<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class IndexController extends Controller
{

    public function index(int $group)
    {
        $group = Group::find($group);
        return view('index.index', compact('group'));
    }
}
