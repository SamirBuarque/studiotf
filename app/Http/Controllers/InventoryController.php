<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index() {
        return view('inventory.index');
    }

    public function create() {
        return view('inventory.create');
    }

    public function store(Request $request) {
        Inventory::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'total_quantity' => $request->input('quantity')
        ]);

        return redirect()->back()->with('success', 'Inventário adicionado com sucesso');
    }

    public function edit(Request $request, $id) {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }
}
