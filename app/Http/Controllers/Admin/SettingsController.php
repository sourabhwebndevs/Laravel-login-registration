<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $settings = Cache::get('site_settings', ['site_name' => config('app.name')]);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
        ]);

        Cache::put('site_settings', $data);

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated.');
    }
}
