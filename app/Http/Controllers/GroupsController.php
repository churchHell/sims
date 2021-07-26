<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GroupsController extends Controller
{
    
    public function index (): View
    {
        return view('groups.index');
    }

}
