<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRecord;
class HomeController extends Controller
{
    public function index(Request $request) {
        $events = EventRecord::all();
        return view('index', compact('events'));
    }
}
