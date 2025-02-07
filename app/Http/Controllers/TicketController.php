<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::with(['department', 'designation', 'building', 'manager'])->find(Auth::id());
        return view('tickets.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function getItems()
    {
        $items = Item::orderBy('name')->get();

        return response()->json($items);
    }

    public function addItem(Request $request)
    {
        $item = Item::find($request->product_id);

        if (!$item) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'id' => $item->id,
            'name' => $item->name,
            'item_code' => $item->item_code
        ]);
    }
}
