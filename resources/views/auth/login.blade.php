<x-guest-layout>
    <h4 class="text-center mb-4 fw-bold">تسجيل الدخول</h4>

    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">تذكرني</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
                دخول
            </button>
        </div>

        <div class="auth-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
            @endif
        </div>
    </form>
</x-guest-layout>
