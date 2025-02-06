<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketCategories = TicketCategory::all();
        return view('ticket-categories.index', compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket-categories.create');
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

        if($request->is_active) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        TicketCategory::create(
            [
                'name' => $request->name,
                'is_active' => $is_active,
            ]
        );

        return redirect()->route('ticket-categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketCategory $ticketCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketCategory $ticketCategory)
    {
        return view('ticket-categories.edit', compact('ticketCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketCategory $ticketCategory)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $is_active = 1;

        if($request->is_active) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }

        $ticketCategory->update(
            [
                'name' => $request->name,
                'is_active' => $is_active,
            ]
        );

        return redirect()->route('ticket-categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();

        return redirect()->route('ticket-categories.index')->with('success', 'Category deleted successfully.');
    }
}
