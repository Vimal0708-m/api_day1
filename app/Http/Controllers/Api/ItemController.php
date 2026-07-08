<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Get all items
    public function index()
    {
        return response()->json(Item::latest()->get());
    }

    // Create a new item
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $item = Item::create($data);

        return response()->json($item, 201);
    }

    // Get one item
    public function show(Item $item)
    {
        return response()->json($item);
    }

    // Update an item
    public function update(Request $request, Item $item)
    {
        $items=Item::find($item);
        if (!$items) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
        ]);

        $item->update($data);

        return response()->json($item);
    }

    // Delete an item
    public function destroy(Item $item)
    {
        $items=Item::find($item);
        if (!$items) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $item->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}
