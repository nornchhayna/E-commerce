<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Http\Request;

// class AdminManagementController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $admins = User::where('role', 'admin')->paginate(10);
//         return view('admin.admins.index', compact('admins'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('admin.admins.create');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8',
//             'store_name' => 'nullable|string|max:255',
//             'is_active' => 'boolean',
//         ]);

//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => bcrypt($request->password),
//             'role' => 'admin',
//             'store_name' => $request->store_name,
//             'is_active' => $request->is_active ?? false,
//         ]);

//         return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         $admin = User::findOrFail($id);
//         return view('admin.admins.edit', compact('admin'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $admin = User::findOrFail($id);

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
//             'password' => 'nullable|string|min:8',
//             'store_name' => 'nullable|string|max:255',
//             'is_active' => 'boolean',
//         ]);

//         $data = $request->only('name', 'email', 'store_name', 'is_active');

//         if ($request->filled('password')) {
//             $data['password'] = bcrypt($request->password);
//         }

//         $admin->update($data);

//         return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         $admin = User::findOrFail($id);
//         $admin->delete();

//         return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
//     }
// }