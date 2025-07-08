<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->latest()->get();
        return view('customer.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('customer.addresses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:billing,shipping',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'is_default' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->is_default) {
                Address::where('user_id', Auth::id())
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }

            Address::create([
                'user_id' => Auth::id(),
                'type' => $request->type,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'is_default' => $request->is_default ?? false,
            ]);

            return redirect()->route('addresses.index')
                ->with('success', 'Address created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create address.')
                ->withInput();
        }
    }

    public function show(Address $address)
    {
        $this->authorizeAddress($address);
        return view('customer.addresses.show', compact('address'));
    }

    public function edit(Address $address)
    {
        $this->authorizeAddress($address);
        return view('customer.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $this->authorizeAddress($address);

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:billing,shipping',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'is_default' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->is_default) {
                Address::where('user_id', Auth::id())
                    ->where('is_default', true)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }

            $address->update([
                'type' => $request->type,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'is_default' => $request->is_default ?? false,
            ]);

            return redirect()->route('addresses.index')
                ->with('success', 'Address updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update address.')
                ->withInput();
        }
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        try {
            $address->delete();
            return redirect()->route('addresses.index')
                ->with('success', 'Address deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete address.');
        }
    }

    private function authorizeAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
