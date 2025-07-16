<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\EventsInventory;
use App\Models\EventRecord;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        return $inventory;
    }

    public function delete($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return response()->json(['message', 'Inventário excluído com sucesso'], 200);
    }

    public function update(Request $request, Inventory $inventory)
    {
        $inventory->name = $request->input('name');
        $inventory->category = $request->input('category');
        $inventory->total_quantity = $request->input('quantity');
        $inventory->save();
        return redirect()->route('inventory.index')->with('success', 'Inventario editado com sucesso');
    }

    public function store(Request $request)
    {
        foreach ($request->inventoryList as $item) {
            $existItem = EventsInventory::where('inventory_id', $item['id'])->first();
            $inventory = Inventory::findOrFail($item['id']);
            if ($existItem) {
                if ($item['quantity'] <= $inventory->available_quantity) {
                    $existItem->reserved += $item['quantity'];
                    $existItem->save();
                    return response()->json(['message' => 'Inventário adicionado com sucesso.'], 201);
                }
                return response()->json(['message' => 'Quantidade solicitada execede o disponível.'], 400); 
            } else {
                EventsInventory::create([
                    'event_record_id' => $request->eventId,
                    'inventory_id' => $item['id'],
                    'reserved' => $item['quantity']
                ]);
            }
        }
        return response()->json(['message' => 'Inventário adicionado com sucesso.'], 201);
    }

    public function linkedInventory(EventRecord $eventRecord)
    {
        $data = [];
        foreach ($eventRecord->inventory as $inventory) {
            $data[] = [
                'id' => $inventory->id,
                'name' => $inventory->name,
                'category' => $inventory->category,
                'reserved' => $inventory->pivot->reserved
            ];
        }
        return $data;
    }

    public function unlinkInventory(Request $request) {
        $inventory = EventsInventory::where('inventory_id', $request->inventoryId)
            ->where('event_record_id', $request->eventId)
            ->first();
        $inventory->delete();
        return response()->json(['message' => 'Inventário desvinculado com sucesso'], 200);
    }
}
