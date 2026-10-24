<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class LiveMapController extends Controller
{
    public function index()
    {
        $incidents = Incident::latest()->get();
        return view('live-map', compact('incidents'));
    }
}