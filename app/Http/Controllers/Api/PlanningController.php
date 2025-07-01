<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\EventRecord;

class PlanningController extends Controller
{
    public function index(EventRecord $eventRecord)
    {
        $plannings = $eventRecord->planning;
        return response()->json($plannings);
    }

    public function store(Request $request, EventRecord $eventRecord)
    {
        $data = $request->validate([
            'text' => 'required|string|max:255'
        ]);
        $data['event_record_id'] = $eventRecord->id;
        $planning = $eventRecord->planning()->create($data);
        return response()->json($planning, 201);
    }
    public function destroy($id)
    {
        $planning = Planning::findOrFail($id);
        $planning->delete();
    }
    public function update(Request $request, EventRecord $eventRecord, Planning $planning)
    {
        try {
            $planning = Planning::findOrFail($planning->id);
            $planning->checked = $request->checked;
            $planning->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 0);
        }
        return response()->json($planning, 200);

    }
}
