<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar-container {
            background: linear-gradient(180deg, #160F1A 0%, #1a1320 100%);
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-container::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(210, 109, 107, 0.1) 0%, rgba(201, 182, 199, 0.1) 100%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-20px, 20px);
            }
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(119, 114, 146, 0.2);
            position: relative;
            z-index: 1;
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #FEFDFD 0%, #C9B6C7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-icon {
            font-size: 2rem;
            filter: drop-shadow(0 4px 8px rgba(210, 109, 107, 0.3));
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
            padding-bottom: 100px;
            max-width: 100%;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1.25rem;
            color: #C9B6C7;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(210, 109, 107, 0.2) 0%, rgba(201, 182, 199, 0.2) 100%);
            transition: width 0.3s ease;
            border-radius: 12px;
        }

        .nav-item:hover::before {
            width: 100%;
        }

        .nav-item:hover {
            color: #FEFDFD;
            transform: translateX(8px);
            background: rgba(119, 114, 146, 0.2);
            box-shadow: 0 4px 12px rgba(210, 109, 107, 0.15);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(210, 109, 107, 0.3) 0%, rgba(201, 182, 199, 0.3) 100%);
            color: #FEFDFD;
            border-left: 4px solid #D26D6B;
            box-shadow: 0 4px 16px rgba(210, 109, 107, 0.2);
        }

        .nav-item.active::before {
            width: 100%;
        }

        .nav-icon {
            font-size: 1.25rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .nav-item:hover .nav-icon {
            transform: scale(1.2);
        }

        .nav-item span:last-child {
            position: relative;
            z-index: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(119, 114, 146, 0.3) 50%, transparent 100%);
            margin: 1rem 0;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            border-top: 1px solid rgba(119, 114, 146, 0.2);
            background: rgba(22, 15, 26, 0.9);
            backdrop-filter: blur(10px);
        }

        .footer-text {
            font-size: 0.75rem;
            text-align: center;
            color: #777292;
        }

        .close-sidebar {
            display: none;
            position: absolute;
            top: 1.5rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #C9B6C7;
            font-size: 1.5rem;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s;
            line-height: 1;
        }

        .close-sidebar:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FEFDFD;
        }

        /* Overlay untuk mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        /* Main content adjustment */
        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
            background: #f3f4f6;
            transition: margin-left 0.3s ease;
        }

        /* Header styles */
        .top-header {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #4B5563;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .menu-toggle:hover {
            color: #000;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-size: 0.875rem;
            color: #4B5563;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #EF4444;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s;
        }

        .logout-btn:hover {
            color: #DC2626;
        }

        .main-content {
            padding: 1.5rem;
        }

        /* Smooth scrollbar for sidebar */
        .sidebar-container::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-container::-webkit-scrollbar-track {
            background: rgba(119, 114, 146, 0.1);
        }

        .sidebar-container::-webkit-scrollbar-thumb {
            background: rgba(210, 109, 107, 0.3);
            border-radius: 3px;
        }

        .sidebar-container::-webkit-scrollbar-thumb:hover {
            background: rgba(210, 109, 107, 0.5);
        }

        /* Responsive Styles */

        /* Tablet (768px - 1024px) - Sidebar tetap terbuka */
        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar-container {
                width: 260px;
            }

            .main-wrapper {
                margin-left: 260px;
            }
        }

        /* Mobile (<768px) - Sidebar tersembunyi by default, bisa dibuka dengan toggle */
        @media (max-width: 768px) {
            .sidebar-container {
                transform: translateX(-100%);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            }

            .sidebar-container.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .close-sidebar {
                display: block;
            }
        }

        /* Small Mobile (<640px) */
        @media (max-width: 640px) {
            .user-name {
                display: none;
            }

            .top-header {
                padding: 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            .sidebar-title {
                font-size: 1.25rem;
            }

            .sidebar-header {
                padding: 1.5rem 1rem;
            }
        }

        /* Large Desktop (>1440px) */
        @media (min-width: 1441px) {
            .main-wrapper {
                max-width: 1920px;
                margin-left: 280px;
                margin-right: auto;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar-container');
            const overlay = document.querySelector('.sidebar-overlay');
            const menuToggle = document.querySelector('.menu-toggle');
            const closeSidebar = document.querySelector('.close-sidebar');
            const navItems = document.querySelectorAll('.nav-item');

            function openSidebar() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('show');
                    overlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeSidebarFunc() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', openSidebar);
            }

            if (closeSidebar) {
                closeSidebar.addEventListener('click', closeSidebarFunc);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebarFunc);
            }

            // Close sidebar when clicking nav item on mobile
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        closeSidebarFunc();
                    }
                });
            });

            // Handle window resize - auto close mobile menu when resizing to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</head>

<body>

    {{-- Overlay untuk mobile saja --}}
    <div class="sidebar-overlay"></div>

    {{-- Sidebar --}}
    <aside class="sidebar-container">

        {{-- Close button untuk mobile saja --}}
        <button class="close-sidebar">×</button>

        {{-- Header --}}
        <div class="sidebar-header">
            <div class="sidebar-title">
                <span class="sidebar-icon">📘</span>
                <span>E-Raport</span>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <div>
                <a href="{{ route('dashboard') }}"
                    class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏠</span>
                    <span>Dashboard</span>
                </a>
            </div>

            <div>
                <a href="{{ route('students.index') }}"
                    class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span>
                    <span>Tambah Anggota</span>
                </a>
            </div>

            <div>
                <a href="{{ route('reports.index') }}"
                    class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span>Rekapan Raport</span>
                </a>
            </div>

            <div class="nav-divider"></div>

            <div>
                <a href="{{ route('reports.history') }}"
                    class="nav-item {{ request()->routeIs('history.*') ? 'active' : '' }}">
                    <span class="nav-icon">📜</span>
                    <span>History</span>
                </a>
            </div>

            <div>
                <a href="{{ route('profile.edit') }}"
                    class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <span class="nav-icon">⚙️</span>
                    <span>Profile</span>
                </a>
            </div>
        </nav>

        {{-- Footer --}}
        <div class="sidebar-footer">
            <p class="footer-text">© 2024 E-Raport System</p>
        </div>
    </aside>

    {{-- Main Content Wrapper --}}
    <div class="main-wrapper">

        {{-- Top Header --}}
        <header class="top-header">
            <div class="header-title">
                <button class="menu-toggle">☰</button>
                <h1 style="font-size: 1.25rem; font-weight: 600; color: #1F2937;">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            <div class="header-user">
                <span class="user-name">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="flash-data"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flash = document.getElementById("flash-data");

            const success = flash.dataset.success;
            const error = flash.dataset.error;

            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: success,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }

            if (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error,
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>