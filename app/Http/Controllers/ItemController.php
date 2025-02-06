<?php

namespace App\Http\Controllers;

use App\Enums\UnitOfMeasure;
use App\Models\Item;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('ticketCategory')->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ticketCategories = TicketCategory::orderBy('name')->get();
        $unitOfMeasures = UnitOfMeasure::cases();

        return view('items.create', compact('ticketCategories', 'unitOfMeasures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $is_active = 1;

        if ($request->is_active) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        Item::create([
            'name' => $request->name,
            'ticket_category_id' => $request->category_id,
            'uom' => $request->uom,
            'description' => $request->description,
            'is_active' => $is_active,
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $ticketCategories = TicketCategory::orderBy('name')->get();
        $unitOfMeasures = UnitOfMeasure::cases();

        return view('items.edit', compact('item', 'ticketCategories', 'unitOfMeasures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $is_active = 1;

        if ($request->is_active) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $item->update([
            'name' => $request->name,
            'ticket_category_id' => $request->category_id,
            'uom' => $request->uom,
            'description' => $request->description,
            'is_active' => $is_active,
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
