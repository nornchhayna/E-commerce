<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications->sortByDesc('created_at');
        return view('admin.notifications.index', compact('notifications'));
    }
}
