<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class EmployeeDashboardController extends Controller
{
    public function index(): View
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        $recentOrders = Order::latest()->take(10)->get();
        
        return view('employee.dashboard', [
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
            'recentOrders' => $recentOrders,
        ]);
    }
}
