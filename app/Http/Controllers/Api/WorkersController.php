<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRecord;
use App\Models\Workers;

class WorkersController extends Controller
{
    public function unrelatedWorkers() {
        $workers = Workers::whereNull('event_record_id')->get();
        return response()->json($workers);
    }

    public function linkedWorkers(EventRecord $eventRecord) {
        $workers = Workers::where('event_record_id', $eventRecord->id)->get();
        return response()->json($workers);
    }

    public function store(EventRecord $eventRecord, Request $request) {
        $workersData = $request->input('selectedWorkers', []);
        foreach($workersData as $workerData) {
            $worker = Workers::findOrFail($workerData['id']);
            $worker->eventRecord()->associate($eventRecord);
            $worker->save();
        }
        return response()->json(['message: sucesso ao vincular trabalhadores'], 200);
    }

        public function unlinkWorker(EventRecord $eventRecord, Request $request) {
            $worker = Workers::findOrFail( $request->input('workerId') );
            $worker->eventRecord()->disassociate();
            $worker->save();
            return response()->json(['message' => 'trabalhador desvinculado com sucesso'], 200);
        }

}
