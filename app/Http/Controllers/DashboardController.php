<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $staffs = User::where('is_admin', false)->get()->count();
    $admins = User::where('is_admin', true)->get()->count();
    $shares = Share::all()->count();
    $storage = Share::all()->sum('size');

    return view('dashboard', compact('staffs', 'admins', 'shares', 'storage'));
  }
}
