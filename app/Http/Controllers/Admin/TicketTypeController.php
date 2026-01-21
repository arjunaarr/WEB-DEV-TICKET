<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::all();
        return view('admin.ticket_types.index', compact('ticketTypes'));
    }

    public function create()
    {
        return view('admin.ticket_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:ticket_types,nama',
        ]);

        TicketType::create($request->all());

        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil ditambahkan.');
    }

    public function edit(TicketType $ticketType)
    {
        return view('admin.ticket_types.edit', compact('ticketType'));
    }

    public function update(Request $request, TicketType $ticketType)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:ticket_types,nama,' . $ticketType->id,
        ]);

        $ticketType->update($request->all());

        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil diperbarui.');
    }

    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil dihapus.');
    }
}
