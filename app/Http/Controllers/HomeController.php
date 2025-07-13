<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRecord;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index(Request $request) {
        $events = EventRecord::orderBy('date', 'asc')->get();
        return view('index', compact('events'));
    }
}
