@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">لوحة تحكم المسؤول</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">مرحباً بك {{ auth()->user()->name }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Orders -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">إجمالي الطلبات</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">إجمالي العملاء</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCustomers }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Drivers -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">إجمالي السائقين</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalDrivers }}</p>
                    </div>
                    <div class="bg-purple-100 dark:bg-purple-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">إجمالي المستخدمين</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-orange-100 dark:bg-orange-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3.914a.5.5 0 01-.5-.5V5.5a.5.5 0 01.5-.5h10.172a2 2 0 012 2v13a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Admins -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">المسؤولون</h3>
                <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $totalAdmins }}</p>
            </div>

            <!-- Employees -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">الموظفون</h3>
                <p class="text-4xl font-bold text-green-600 dark:text-green-400">{{ $totalEmployees }}</p>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">آخر الطلبات</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">رقم الطلب</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">العميل</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">الحالة</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $order->customer->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($order->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $order->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">لا توجد طلبات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                إدارة المستخدمين
            </a>
            <a href="{{ route('orders.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                إدارة الطلبات
            </a>
            <a href="{{ route('customers.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                إدارة العملاء
            </a>
        </div>
    </div>
</div>
@endsection
