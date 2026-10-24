<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    // عرض البلاغات في الداشبورد مع دعم البحث
    public function index(Request $request)
    {
        $search = $request->input('search');

        // جلب البلاغات مع البحث بالtitle أو location لو المستخدم كتب حاجة
        $incidents = Incident::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('location', 'like', "%{$search}%")
                         ->orWhere('type', 'like', "%{$search}%");
        })->latest()->get();

        return view('incidents', compact('incidents', 'search'));
    }
}