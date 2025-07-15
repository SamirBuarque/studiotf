<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRecord;
use App\Models\Workers;

class WorkersController extends Controller
{
    public function index() {
        $workers = Workers::with("eventRecord")->get();
        return view('worker.index', compact('workers'));
    }

    public function create()
    {
        return view("worker.create");
    }

    public function edit(Workers $worker) {
        return view("worker.edit", compact("worker"));
    }
    public function unrelatedWorkers()
    {
        $workers = Workers::whereNull('event_record_id')->get();
        return response()->json($workers);
    }

    public function linkedWorkers(EventRecord $eventRecord)
    {
        $workers = Workers::where('event_record_id', $eventRecord->id)->get();
        return response()->json($workers);
    }

    public function linkWorker(EventRecord $eventRecord, Request $request)
    {
        $workersData = $request->input('selectedWorkers', []);
        foreach ($workersData as $workerData) {
            $worker = Workers::findOrFail($workerData['id']);
            $worker->eventRecord()->associate($eventRecord);
            $worker->save();
        }
        return response()->json(['message: sucesso ao vincular trabalhadores'], 200);
    }

    public function unlinkWorker(EventRecord $eventRecord, Request $request)
    {
        $worker = Workers::findOrFail($request->input('workerId'));
        $worker->eventRecord()->disassociate();
        $worker->save();
        return response()->json(['message' => 'trabalhador desvinculado com sucesso'], 200);
    }

    public function store(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "birth_date" => "date",
            "position" => "string|max:255"
        ]);
        Workers::create([
            "name" => $request->input("name"),
            "birth_date" => $request->input("birth_date"),
            "position" => $request->input("position")
        ]);
        
        return redirect()->route("worker.create")->with("success","Trabalhador adicionado com sucesso");
    }

    public function destroy(Workers $worker) {
        $worker->delete();
        return redirect()->route("worker.index")->with("success", "Trabalhador deletado com sucesso");
    }

    public function update(Request $request, Workers $worker) {
        $worker->update([
            "name" => $request->input("name"),
            "birth_date" => $request->input("birth_date"),
            "position" => $request->input("position")
        ]);
        $worker->save();
        return redirect()->route("worker.index")->with("success", "Trabalhador atualizado com sucesso");
    }

}
