<div class="sidebar-header">
    <h3 class="mb-0 fw-bold">RocketApp</h3>
    <small class="text-white-50">
        @if(auth()->check())
            {{ auth()->user()->role === 'admin' ? 'لوحة المسؤول' : 'لوحة الموظف' }}
        @endif
    </small>
</div>

<ul class="list-unstyled components">
    @if(auth()->check())
        @if(auth()->user()->role === 'admin')
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                </a>
            </li>
            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> إدارة المستخدمين
                </a>
            </li>
            <li class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <a href="{{ route('orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> الطلبات
                </a>
            </li>
            <li class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <a href="{{ route('customers.index') }}">
                    <i class="fas fa-user-friends"></i> العملاء
                </a>
            </li>
            <li class="{{ request()->routeIs('delivery-drivers.*') ? 'active' : '' }}">
                <a href="{{ route('delivery-drivers.index') }}">
                    <i class="fas fa-truck"></i> السائقون
                </a>
            </li>
            <li class="{{ request()->routeIs('governorates.*') ? 'active' : '' }}">
                <a href="{{ route('governorates.index') }}">
                    <i class="fas fa-map-marked-alt"></i> المحافظات
                </a>
            </li>
            <li class="{{ request()->routeIs('areas.*') ? 'active' : '' }}">
                <a href="{{ route('areas.index') }}">
                    <i class="fas fa-map-marker-alt"></i> المناطق
                </a>
            </li>
            <li class="{{ request()->routeIs('order-types.*') ? 'active' : '' }}">
                <a href="{{ route('order-types.index') }}">
                    <i class="fas fa-list"></i> أنواع الطلبات
                </a>
            </li>
            <li class="{{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                <a href="{{ route('activity-logs.index') }}">
                    <i class="fas fa-history"></i> سجل النشاط
                </a>
            </li>
        @else
            <li class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                <a href="{{ route('employee.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> لوحة التحكم
                </a>
            </li>
            <li class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                <a href="{{ route('orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> الطلبات
                </a>
            </li>
            <li class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
                <a href="{{ route('customers.index') }}">
                    <i class="fas fa-user-friends"></i> العملاء
                </a>
            </li>
            <li class="{{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                <a href="{{ route('activity-logs.index') }}">
                    <i class="fas fa-history"></i> سجل النشاط
                </a>
            </li>
        @endif

        <li class="mt-4 px-3">
            <hr class="bg-light opacity-25">
        </li>

        <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-cog"></i> الإعدادات
            </a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="text-danger">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </a>
            </form>
        </li>
    @else
        <li>
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
            </a>
        </li>
        <li>
            <a href="{{ route('register') }}">
                <i class="fas fa-user-plus"></i> إنشاء حساب
            </a>
        </li>
    @endif
</ul>
