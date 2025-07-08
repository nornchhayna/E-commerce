<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $user = Auth::user();

//         switch ($user->role) {
//             case 'super_admin':
//                 $data = [
//                     'total_customers' => User::where('role', 'customer')->count(),
//                     'total_admins' => User::where('role', 'admin')->count(),
//                     'approved_customers' => User::where('role', 'customer')->where('is_approved', 1)->count(),
//                     'customers' => User::where('role', 'customer')->latest()->take(10)->get(),
//                 ];
//                 break;

//             case 'admin':
//                 $myCustomers = $user->getMyCustomers();
//                 $data = [
//                     'my_customers_count' => $myCustomers->count(),
//                     'approved_customers' => $myCustomers->where('is_approved', 1)->count(),
//                     'pending_customers' => $myCustomers->where('is_approved', 0)->count(),
//                     'customers' => $myCustomers->take(10),
//                 ];
//                 break;

//             case 'customer':
//                 $data = [
//                     'all_customers' => User::where('role', 'customer')->get(),
//                     'total_customers' => User::where('role', 'customer')->count(),
//                 ];
//                 break;
//         }

//         return view('dashboard', compact('data'));
//     }
// }