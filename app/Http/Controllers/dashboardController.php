<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class dashboardController extends Controller
{
    public function dashboardView()
    {
        // $userId = Auth::id();
        // dd($userId);
        return view('Stats.dashboard');
    }
}
