<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentApiController extends Controller
{
    // 1. جلب كل البلاغات للموبايل
    public function index()
    {
        $incidents = Incident::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'تم جلب البلاغات بنجاح',
            'data' => $incidents
        ], 200);
    }

    // 2. استقبال بلاغ جديد من تطبيق الموبايل وحفظه في الـ DB
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $incident = Incident::create([
            'title' => $request->title,
            'type' => $request->type,
            'location' => $request->location,
            'status' => 'active', // البلاغ الجديد بيكون نشط تلقائياً
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إرسال البلاغ بنجاح وسماعه في غرفة العمليات',
            'data' => $incident
        ], 201);
    }
}
