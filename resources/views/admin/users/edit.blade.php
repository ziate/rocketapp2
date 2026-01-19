@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">تعديل المستخدم</h1>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الاسم</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">كلمة المرور (اتركها فارغة لعدم التغيير)</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الدور</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="admin" @selected($user->role === 'admin')>مسؤول</option>
                        <option value="employee" @selected($user->role === 'employee')>موظف</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                        تحديث المستخدم
                    </button>
                    <a href="{{ route('users.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
