@extends('layouts.app')

@section('title', 'لوحة تحكم المسؤول')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold text-dark mb-1">لوحة تحكم المسؤول</h2>
        <p class="text-muted">مرحباً بك مجدداً، {{ auth()->user()->name }}</p>
    </div>
</div>

<!-- Stats Grid -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 p-3 me-3">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">إجمالي الطلبات</h6>
                    <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-success-subtle text-success rounded-3 p-3 me-3">
                    <i class="fas fa-user-friends fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">إجمالي العملاء</h6>
                    <h3 class="fw-bold mb-0">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-info-subtle text-info rounded-3 p-3 me-3">
                    <i class="fas fa-truck fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">إجمالي السائقين</h6>
                    <h3 class="fw-bold mb-0">{{ $totalDrivers }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 bg-warning-subtle text-warning rounded-3 p-3 me-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">إجمالي المستخدمين</h6>
                    <h3 class="fw-bold mb-0">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- User Distribution -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">توزيع المستخدمين</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted"><i class="fas fa-user-shield text-primary me-2"></i> المسؤولون</span>
                    <span class="fw-bold">{{ $totalAdmins }}</span>
                </div>
                <div class="progress mb-4" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $totalUsers > 0 ? ($totalAdmins / $totalUsers) * 100 : 0 }}%"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted"><i class="fas fa-user-tie text-success me-2"></i> الموظفون</span>
                    <span class="fw-bold">{{ $totalEmployees }}</span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalUsers > 0 ? ($totalEmployees / $totalUsers) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">آخر الطلبات</h5>
                <a href="{{ route('orders.index') }}" class="btn btn-sm btn-light text-primary fw-bold">عرض الكل</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="px-4 py-3">رقم الطلب</th>
                                <th class="px-4 py-3">العميل</th>
                                <th class="px-4 py-3">الحالة</th>
                                <th class="px-4 py-3">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-4 py-3 fw-bold">#{{ $order->id }}</td>
                                    <td class="px-4 py-3 text-muted">{{ $order->customer->name ?? 'غير معروف' }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusClass = match($order->status) {
                                                'completed' => 'bg-success',
                                                'pending' => 'bg-warning',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-2 py-1">{{ $order->status }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-muted small">{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-5 text-center text-muted">لا توجد طلبات حديثة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4">
    <div class="col-md-4">
        <a href="{{ route('users.index') }}" class="card border-0 shadow-sm text-decoration-none hover-shadow transition h-100">
            <div class="card-body text-center py-4">
                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-user-cog fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">إدارة المستخدمين</h5>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('orders.index') }}" class="card border-0 shadow-sm text-decoration-none hover-shadow transition h-100">
            <div class="card-body text-center py-4">
                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-box-open fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">إدارة الطلبات</h5>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('customers.index') }}" class="card border-0 shadow-sm text-decoration-none hover-shadow transition h-100">
            <div class="card-body text-center py-4">
                <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-address-book fa-lg"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">إدارة العملاء</h5>
            </div>
        </a>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition {
        transition: all 0.3s ease;
    }
    .bg-primary-subtle { background-color: #e7f1ff; }
    .bg-success-subtle { background-color: #e6fffa; }
    .bg-info-subtle { background-color: #e7faff; }
    .bg-warning-subtle { background-color: #fff9e6; }
</style>
@endsection
