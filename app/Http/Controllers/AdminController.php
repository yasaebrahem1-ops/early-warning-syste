<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Fleet;
use App\Models\Traffic;
use App\Models\User;

class AdminController extends Controller
{
    // 1. الصفحة الرئيسية (Dashboard)
    public function dashboard()
    {
        // جلب آخر 5 بلاغات
        $incidents = class_exists(Incident::class) ? Incident::latest()->take(5)->get() : collect([]);
        $totalIncidents = class_exists(Incident::class) ? Incident::count() : 8;
        $activeIncidents = class_exists(Incident::class) ? Incident::where('status', 'active')->count() : 3;
        $totalFleet = class_exists(Fleet::class) ? Fleet::count() : 25;
        
        return view('admin.dashboard', compact('incidents', 'totalIncidents', 'activeIncidents', 'totalFleet'));
    }

    // 2. الخريطة المباشرة (Live Map)
    public function liveMap()
    {
        $incidents = class_exists(Incident::class) ? Incident::all() : collect([]);
        return view('admin.live-map', compact('incidents'));
    }

    // 3. أسطول الطوارئ (Emergency Fleet)
    public function fleet()
    {
        $fleets = class_exists(Fleet::class) ? Fleet::all() : collect([]);
        $totalFleet = class_exists(Fleet::class) ? Fleet::count() : 25;
        $availableFleet = class_exists(Fleet::class) ? Fleet::where('status', 'متاحة')->count() : 18;
        $activeMissions = class_exists(Fleet::class) ? Fleet::where('status', 'في مهمة')->count() : 3;
        
        return view('admin.fleet', compact('fleets', 'totalFleet', 'availableFleet', 'activeMissions'));
    }

    // 4. إدارة البلاغات (Incidents)
    public function incidents(Request $request)
    {
        $search = $request->input('search');
        
        if (class_exists(Incident::class)) {
            $incidents = Incident::when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%");
            })->latest()->get();
        } else {
            $incidents = collect([]);
        }

        return view('admin.incidents', compact('incidents'));
    }

    // 5. المرور الذكي (Smart Traffic)
    public function smartTraffic()
    {
        $traffics = class_exists(Traffic::class) ? Traffic::all() : collect([]);
        return view('admin.smart-traffic', compact('traffics'));
    }

    // 6. الإعدادات والمستخدمين (Settings)
    public function settings()
    {
        $users = class_exists(User::class) ? User::all() : collect([]);
        return view('admin.settings', compact('users'));
    }
}