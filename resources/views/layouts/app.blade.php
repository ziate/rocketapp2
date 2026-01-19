<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'نظام إدارة التوصيل')</title>
    
    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts (Cairo) -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f7f6;
            overflow-x: hidden;
        }

        :root {
            --sidebar-width: 260px;
            --primary-color: #2c3e50;
            --accent-color: #3498db;
        }

        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            background: var(--primary-color);
            color: #fff;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.1);
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.1em;
            display: block;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.3s;
            border-right: 4px solid transparent;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-right-color: var(--accent-color);
        }

        #sidebar ul li.active > a {
            color: #fff;
            background: rgba(255,255,255,0.15);
            border-right-color: var(--accent-color);
        }

        #sidebar ul li a i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Styles */
        #content {
            width: calc(100% - var(--sidebar-width));
            margin-right: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
        }

        .navbar {
            padding: 15px 20px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 30px;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f1f1;
            font-weight: 600;
            padding: 15px 20px;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-right: calc(var(--sidebar-width) * -1);
            }
            #sidebar.active {
                margin-right: 0;
            }
            #content {
                width: 100%;
                margin-right: 0;
            }
            #content.active {
                margin-right: var(--sidebar-width);
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            @include('partials.sidebar')
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary d-md-none">
                        <i class="fas fa-align-right"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        @auth
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-cog me-2"></i> الملف الشخصي</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="container-fluid px-4">
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Optional but useful for some plugins) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
