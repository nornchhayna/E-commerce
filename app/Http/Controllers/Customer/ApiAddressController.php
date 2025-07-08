<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->latest()->get();
        return response()->json($addresses);
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
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if ($request->is_default) {
                Address::where('user_id', Auth::id())
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }

            $address = Address::create([
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

            return response()->json($address, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create address'], 500);
        }
    }

    public function show(Address $address)
    {
        $this->authorizeAddress($address);
        return response()->json($address);
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
            return response()->json(['errors' => $validator->errors()], 422);
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

            return response()->json($address);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update address'], 500);
        }
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        try {
            $address->delete();
            return response()->json(['message' => 'Address deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete address'], 500);
        }
    }

    private function authorizeAddress(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
