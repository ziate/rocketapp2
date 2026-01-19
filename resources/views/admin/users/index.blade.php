@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إدارة المستخدمين</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">إدارة المسؤولين والموظفين</p>
            </div>
            <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                إضافة مستخدم جديد
            </a>
        </div>

        <!-- Success Message -->
        @if(session('status'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">الاسم</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">البريد الإلكتروني</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">الدور</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">تاريخ الإنشاء</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($user->role === 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @endif">
                                        {{ $user->role === 'admin' ? 'مسؤول' : 'موظف' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        تعديل
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">لا توجد مستخدمين</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
