<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventRecord;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index(EventRecord $eventRecord)
    {
        return response()->json($eventRecord->products);
    }
    public function store(Request $request, EventRecord $eventRecord)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $data['event_record_id'] = $eventRecord->id;
        $product = $eventRecord->products()->create($data);
        return response()->json($product, 201);
    }
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
    }
    public function update(Request $request, EventRecord $eventRecord, Products $product)
    {
        try {
            $product = Products::findOrFail($product->id);
            if ($request->checked === true || $request->checked === false) {
                $product->checked = $request->checked;
            }
            if ($request->quantity != null) {
                $product->quantity = $request->quantity;
            }
            $product->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 0);
        }
        return response()->json($product, 200);

    }
}
