<div class="sidebar-header">
    <h2>RocketApp</h2>
    <p>
        @if(auth()->check())
            {{ auth()->user()->role === 'admin' ? 'لوحة المسؤول' : 'لوحة الموظف' }}
        @endif
    </p>
</div>

<nav class="sidebar-nav">
    @if(auth()->check())
        @if(auth()->user()->role === 'admin')
            <!-- Admin Navigation -->
            <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                </svg>
                لوحة التحكم
            </a>

            <a href="{{ route('users.index') }}" class="@if(request()->routeIs('users.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3.914a.5.5 0 01-.5-.5V5.5a.5.5 0 01.5-.5h10.172a2 2 0 012 2v13a2 2 0 01-2 2z"></path>
                </svg>
                إدارة المستخدمين
            </a>

            <a href="{{ route('orders.index') }}" class="@if(request()->routeIs('orders.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                </svg>
                الطلبات
            </a>

            <a href="{{ route('customers.index') }}" class="@if(request()->routeIs('customers.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                العملاء
            </a>

            <a href="{{ route('delivery-drivers.index') }}" class="@if(request()->routeIs('delivery-drivers.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                السائقون
            </a>

            <a href="{{ route('governorates.index') }}" class="@if(request()->routeIs('governorates.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 003 16.382V5.618a1 1 0 011.553-.894L9 7.16"></path>
                </svg>
                المحافظات
            </a>

            <a href="{{ route('areas.index') }}" class="@if(request()->routeIs('areas.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 003 16.382V5.618a1 1 0 011.553-.894L9 7.16"></path>
                </svg>
                المناطق
            </a>

            <a href="{{ route('order-types.index') }}" class="@if(request()->routeIs('order-types.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
                أنواع الطلبات
            </a>

            <a href="{{ route('activity-logs.index') }}" class="@if(request()->routeIs('activity-logs.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                سجل النشاط
            </a>

        @else
            <!-- Employee Navigation -->
            <a href="{{ route('employee.dashboard') }}" class="@if(request()->routeIs('employee.dashboard')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                </svg>
                لوحة التحكم
            </a>

            <a href="{{ route('orders.index') }}" class="@if(request()->routeIs('orders.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                </svg>
                الطلبات
            </a>

            <a href="{{ route('customers.index') }}" class="@if(request()->routeIs('customers.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                العملاء
            </a>

            <a href="{{ route('activity-logs.index') }}" class="@if(request()->routeIs('activity-logs.*')) active @endif">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                سجل النشاط
            </a>
        @endif

        <!-- Shared Navigation -->
        <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 1rem 0;">

        <a href="{{ route('profile.edit') }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            الإعدادات
        </a>

        <form action="{{ route('logout') }}" method="POST" style="display: block;">
            @csrf
            <button type="submit" style="padding: 0.75rem 1rem; color: rgba(255, 255, 255, 0.8); text-decoration: none; border: none; background: none; cursor: pointer; width: 100%; text-align: right; transition: all 0.3s ease; font-size: 0.95rem; display: flex; align-items: center;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem; margin-left: 0.75rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                تسجيل الخروج
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">تسجيل الدخول</a>
        <a href="{{ route('register') }}">إنشاء حساب</a>
    @endif
</nav>
