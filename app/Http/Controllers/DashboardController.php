<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;

class DashboardController extends Controller
{
    public function index()
    {
        $userGroups = UserGroup::all();
        $users = User::all();

        return view('dashboard', compact('userGroups', 'users'));
    }
}
