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
        //
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
    public function show(EventRecord $eventRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
