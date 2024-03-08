<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\Models\Event;
use App\Models\User;
use App\Models\Category;

class dashboardController extends Controller
{
    public function dashboardView()
    {
        $eventStatistics = Event::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as event_count')
        )
        ->groupBy('date')
        ->get();

        // Nombre total d'
        $totalevents = event::count();
        $totalusers = user::count();
        $totalcategories = category::count();
        $users = user::all();

        return view('Stats.dashboard', [
            'eventStatistics' => $eventStatistics,
            'totalevents' => $totalevents,
            'totalusers' => $totalusers,
            'totalcategories' => $totalcategories,
            'users' => $users
        ]);
    }
}
