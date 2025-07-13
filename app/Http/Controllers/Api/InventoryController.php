<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index() {
        $inventory = Inventory::all();
        return $inventory;
    }

    public function delete($id) {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return response()->json(['message', 'Inventário excluído com sucesso'], 200);
    }

    public function update(Request $request, Inventory $inventory) {
        $inventory->name = $request->input('name');
        $inventory->category = $request->input('category');
        $inventory->total_quantity = $request->input('quantity');
        $inventory->save();
        return redirect()->route('inventory.index')->with('success', 'Inventario editado com sucesso');
    }
}
