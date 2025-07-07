<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRecordRequest;
use App\Http\Requests\UpdateEventRecordRequest;
use App\Models\EventRecord;
use Illuminate\Http\Request;

class EventRecordController extends Controller
{
    public function index()
    {
        $events = EventRecord::all();
        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event_record.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|max:255'
        ]);

        EventRecord::create([
            'name' => $request->name,
            'city' => $request->city,
            'state' => $request->state,
            'date' => $request->date,
            'status' => $request->status
        ]);

        return redirect()->route('index')->with('success', 'Evento adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = EventRecord::findOrFail($id);
        $plannings = $event->planning;
        $files = $event->file()->get();
        return view('event_record.detail', compact('event', 'plannings', 'files'));
    }

    public function edit(EventRecord $eventRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRecordRequest $request, EventRecord $eventRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventRecord $eventRecord)
    {
        $event = EventRecord::findOrFail($eventRecord->id);
        $event->planning()->delete();
        $event->delete();
        return redirect()->route('index')->with('success', 'Evento removido com sucesso!');
    }
}
