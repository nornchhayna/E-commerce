<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportAdminController extends Controller
{
    public function index(Request $request)
    {
        // Get search, sort, and direction parameters from the request
        $search = $request->query('search');
        $sort = $request->query('sort', 'created_at');
        $direction = $request->query('direction', 'desc');

        // Build the query to fetch support tickets with related users
        $query = SupportTicket::with('user');

        // If search is provided, add filters to the query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Execute the query with sorting and pagination
        $tickets = $query->orderBy($sort, $direction)->paginate(10);
        $statusClasses = [
            'open' => 'bg-yellow-100 text-yellow-800',
            'closed' => 'bg-green-100 text-green-800',
            'default' => 'bg-gray-100 text-gray-800'
        ];

        return view('admin.support.index', compact('tickets', 'statusClasses'));
    }

    public function edit($id)
    {
        // Find the support ticket by ID
        $ticket = SupportTicket::findOrFail($id);
        return view('admin.support.edit', compact('ticket'));
    }

    public function update(Request $request, SupportTicket $support)
    {
        // Validate incoming request data
        $request->validate([

            'subject' => 'required|string|max:255',
            'store_id' => 'required|exists:stores,id',
            'user_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'status' => 'required|in:open,closed',
        ]);

        // Update the support ticket with validated data
        $support->update($request->only('subject', 'message', 'status'));

        return redirect()->route('admin.support.index')->with('success', 'Ticket updated successfully.');
    }
}
