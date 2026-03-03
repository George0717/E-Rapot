<aside
    class="sidebar-container transition-all duration-300"
    :class="open ? 'block' : 'hidden md:block'"
>
    <style>
        .sidebar-container {
            background: linear-gradient(180deg, #160F1A 0%, #1a1320 100%);
            width: 280px;
            position: relative;
            overflow: hidden;
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
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-20px, 20px); }
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
        }

        .nav-item:hover .nav-icon {
            transform: scale(1.2);
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
            background: rgba(22, 15, 26, 0.5);
            backdrop-filter: blur(10px);
        }

        .footer-text {
            font-size: 0.75rem;
            text-align: center;
            color: #777292;
        }

        /* Tooltip */
        .nav-item-wrapper {
            position: relative;
        }

        .nav-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 1rem;
            background: linear-gradient(135deg, #160F1A 0%, #777292 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .nav-item-wrapper:hover .nav-tooltip {
            opacity: 1;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar-container {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 999;
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            }
        }
    </style>

    <!-- Header -->
    <div class="sidebar-header">
        <div class="sidebar-title">
            <span class="sidebar-icon">📘</span>
            <span>E-Raport</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="nav-item-wrapper">
            <a href="{{ route('dashboard') }}" 
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="nav-item-wrapper">
            <a href="{{ route('students.index') }}" 
               class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <span class="nav-icon">👥</span>
                <span>Tambah Anggota</span>
            </a>
        </div>

        <div class="nav-item-wrapper">
            <a href="{{ route('reports.index') }}" 
               class="nav-item {{ request()->routeIs('reports.index') ? 'active' : '' }}">
                <span class="nav-icon">📊</span>
                <span>Rekapan Raport</span>
            </a>
        </div>


        <div class="nav-divider"></div>

        <div class="nav-item-wrapper">
            <a href="{{ route('reports.history') }}" 
               class="nav-item {{ request()->routeIs('reports.history') ? 'active' : '' }}">
                <span class="nav-icon">📜</span>
                <span>History</span>
            </a>
        </div>

        <div class="nav-item-wrapper">
            <a href="{{ route('profile.edit') }}" 
               class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="nav-icon">⚙️</span>
                <span>Profile</span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <div class="sidebar-footer">
        <p class="footer-text">© 2024 E-Raport System</p>
    </div>
</aside>