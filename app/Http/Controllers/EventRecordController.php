<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRecordRequest;
use App\Http\Requests\UpdateEventRecordRequest;
use App\Models\EventRecord;

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
    public function store(StoreEventRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = EventRecord::findOrFail($id);
        $plannings = $event->planning;
        return view('event_record.detail', compact('event', 'plannings'));
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
        //
    }
}
