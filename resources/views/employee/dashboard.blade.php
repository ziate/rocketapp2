@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">لوحة تحكم الموظف</h1>
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

            <!-- Pending Orders -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">الطلبات المعلقة</p>
                        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pendingOrders }}</p>
                    </div>
                    <div class="bg-yellow-100 dark:bg-yellow-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">الطلبات المكتملة</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $completedOrders }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Cancelled Orders -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">الطلبات الملغاة</p>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $cancelledOrders }}</p>
                    </div>
                    <div class="bg-red-100 dark:bg-red-900 rounded-full p-3">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l5.5-5.5M5.5 10L11 5.5"></path>
                        </svg>
                    </div>
                </div>
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
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">الإجراءات</th>
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
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        عرض
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">لا توجد طلبات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                عرض جميع الطلبات
            </a>
            <a href="{{ route('customers.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                عرض العملاء
            </a>
        </div>
    </div>
</div>
@endsection
