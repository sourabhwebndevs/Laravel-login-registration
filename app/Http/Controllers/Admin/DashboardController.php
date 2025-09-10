<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = Role::where('name', 'admin')->first()?->users()->count() ?? 0;

        // For charts/stats you can expand this with real data or APIs
        return view('admin.dashboard.index', compact('totalUsers', 'totalAdmins'));
    }
}
