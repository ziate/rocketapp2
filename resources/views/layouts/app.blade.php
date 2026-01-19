<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'نظام إدارة التوصيل')</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light);
            color: #1f2937;
            transition: background-color 0.3s ease;
        }

        body.dark {
            background-color: #111827;
            color: #f3f4f6;
        }

        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(135deg, var(--dark) 0%, #374151 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .sidebar-header p {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav a, .sidebar-nav button {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            text-align: right;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar-nav a:hover, .sidebar-nav button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-right: 1.25rem;
        }

        .sidebar-nav a.active {
            background-color: var(--primary);
            color: white;
            border-right: 3px solid white;
        }

        .sidebar-nav svg {
            width: 1.25rem;
            height: 1.25rem;
            margin-left: 0.75rem;
        }

        .main-content {
            margin-right: 250px;
            min-height: 100vh;
            background-color: var(--light);
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu {
            position: relative;
        }

        .user-menu-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu-button:hover {
            background-color: #e5e7eb;
        }

        .user-menu-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            display: none;
            z-index: 100;
            margin-top: 0.5rem;
        }

        .user-menu-dropdown.active {
            display: block;
        }

        .user-menu-dropdown a {
            display: block;
            padding: 0.75rem 1rem;
            color: #1f2937;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .user-menu-dropdown a:hover {
            background-color: #f3f4f6;
        }

        .page-content {
            padding: 2rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #7f1d1d;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-right: 0;
            }

            .topbar {
                padding: 1rem;
            }

            .page-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="sidebar">
            @include('partials.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-left">
                    <h1 class="text-xl font-bold text-gray-900">نظام إدارة التوصيل</h1>
                </div>
                <div class="topbar-right">
                    <!-- User Menu -->
                    @if(auth()->check())
                        <div class="user-menu">
                            <button class="user-menu-button" onclick="toggleUserMenu()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                            <div class="user-menu-dropdown" id="userMenuDropdown">
                                <a href="{{ route('profile.edit') }}">الملف الشخصي</a>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">تسجيل الخروج</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Page Content -->
            <div class="page-content">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <strong>حدث خطأ!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleUserMenu() {
            const dropdown = document.getElementById('userMenuDropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            if (!userMenu.contains(event.target)) {
                document.getElementById('userMenuDropdown').classList.remove('active');
            }
        });
    </script>
</body>
</html>
