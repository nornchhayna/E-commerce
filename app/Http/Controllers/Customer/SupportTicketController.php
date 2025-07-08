<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    /**
     * Display a list of customer's support tickets.
     */
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.support.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        return view('customer.support.create');
    }

    /**
     * Store a new support ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'status' => 'open',
        ]);

        return redirect()->route('support.index')->with('success', 'Support ticket submitted.');
    }

    /**
     * Show a single support ticket.
     */
    public function show($id)
    {
        $ticket = SupportTicket::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('customer.support.show', compact('ticket'));
    }
}
