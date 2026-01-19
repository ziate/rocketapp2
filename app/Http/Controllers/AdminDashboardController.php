<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\DeliveryDriver;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $totalDrivers = DeliveryDriver::count();
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalEmployees = User::where('role', 'employee')->count();
        
        $recentOrders = Order::latest()->take(10)->get();
        $ordersByStatus = Order::groupBy('status')->selectRaw('status, count(*) as total')->get();
        
        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalDrivers' => $totalDrivers,
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalEmployees' => $totalEmployees,
            'recentOrders' => $recentOrders,
            'ordersByStatus' => $ordersByStatus,
        ]);
    }
}
