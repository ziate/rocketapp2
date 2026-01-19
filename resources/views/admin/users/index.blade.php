@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark mb-1">إدارة المستخدمين</h2>
        <p class="text-muted">إدارة المسؤولين والموظفين في النظام</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-user-plus me-1"></i> إضافة مستخدم جديد
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted">
                    <tr>
                        <th class="px-4 py-3">الاسم</th>
                        <th class="px-4 py-3">البريد الإلكتروني</th>
                        <th class="px-4 py-3">الدور</th>
                        <th class="px-4 py-3">تاريخ الإنشاء</th>
                        <th class="px-4 py-3 text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-3 fw-bold text-dark">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if($user->role === 'admin')
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">مسؤول</span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">موظف</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-muted">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="btn-group shadow-sm">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-5 text-center text-muted">
                                <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">لا يوجد مستخدمين حالياً</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
