<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{

    public function index(Group $group): View
    {
        return view('search.index', compact('group'));
    }
}
