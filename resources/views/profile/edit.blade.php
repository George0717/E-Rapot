@extends('layouts.app')
@section('title', 'User')

@section('content')
<div class="profile-container">
    <div class="container-custom">

        <!-- Profile Card -->
        <div class="profile-card animate-fade-in">

            <!-- Header Section -->
            <div class="profile-header">
                <div class="header-background">
                    <div class="bg-orb orb-1"></div>
                    <div class="bg-orb orb-2"></div>
                    <div class="bg-orb orb-3"></div>
                </div>

                <div class="header-content">
                    <div class="avatar-section">
                        <div class="avatar-wrapper">
                            <div class="avatar-ring"></div>
                            <div class="avatar-circle">
                                <span class="avatar-text">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="user-info">
                        <h2 class="user-name">{{ auth()->user()->name }}</h2>
                        <p class="user-email">
                            <i class="bi bi-envelope-fill"></i>
                            <span>{{ auth()->user()->email }}</span>
                        </p>
                        <div class="user-role">
                            <i class="bi bi-shield-check"></i>
                            <span>{{ auth()->user()->role_label }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">

                <!-- Profile Information Section -->
                <div class="section-card animate-slide-up" style="animation-delay: 0.1s">
                    <div class="section-header">
                        <h3 class="section-title">Informasi Profil</h3>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="form-content">
                        @csrf
                        @method('patch')

                        <div class="form-grid">
                            <div class="form-group animate-input" style="animation-delay: 0.15s">
                                <label class="form-label">
                                    <span>Nama Lengkap</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text"
                                        name="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        class="form-input"
                                        placeholder="Masukkan nama lengkap">
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-group animate-input" style="animation-delay: 0.2s">
                                <label class="form-label">
                                    <span>Alamat Email</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="email"
                                        name="email"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        class="form-input"
                                        placeholder="nama@email.com">
                                    <div class="input-underline"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions animate-input" style="animation-delay: 0.25s">
                            <button type="submit" class="btn-primary">
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Password Section -->
                <div class="section-card animate-slide-up" style="animation-delay: 0.2s">
                    <div class="section-header">
                        <h3 class="section-title">Ubah Password</h3>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="form-content">
                        @csrf
                        @method('put')

                        <div class="form-grid">
                            <div class="form-group animate-input" style="animation-delay: 0.25s">
                                <label class="form-label">
                                    <span>Password Lama</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password"
                                        name="current_password"
                                        class="form-input"
                                        placeholder="••••••••">
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-group animate-input" style="animation-delay: 0.3s">
                                <label class="form-label">
                                    <span>Password Baru</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password"
                                        name="password"
                                        class="form-input"
                                        placeholder="••••••••">
                                    <div class="input-underline"></div>
                                </div>
                            </div>

                            <div class="form-group animate-input" style="animation-delay: 0.35s">
                                <label class="form-label">
                                    <span>Konfirmasi Password</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="password"
                                        name="password_confirmation"
                                        class="form-input"
                                        placeholder="••••••••">
                                    <div class="input-underline"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions animate-input" style="animation-delay: 0.4s">
                            <button type="submit" class="btn-secondary">
                                <span>Update Password</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Delete Account Section -->
                <div class="section-card section-danger animate-slide-up" style="animation-delay: 0.3s">
                    <div class="section-header">
                        <h3 class="section-title">Zona Berbahaya</h3>
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}" class="form-content">
                        @csrf
                        @method('delete')

                        <div class="danger-zone">
                            <div class="danger-info">
                                <div class="danger-text">
                                    <h4 class="danger-title">Hapus Akun Permanen</h4>
                                    <p class="danger-desc">
                                        Setelah akun dihapus, semua data akan hilang permanen dan tidak dapat dikembalikan.
                                    </p>
                                </div>
                            </div>

                            <button type="submit"
                                onclick="return confirm('⚠️ Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan!')"
                                class="btn-danger">
                                <i class="bi bi-trash3-fill"></i>
                                <span>Hapus Akun</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap');

    :root {
        /* Colors */
        --cream-bg: #FAF8F3;
        --white-soft: #FFFDFB;
        --primary: #6366F1;
        --primary-dark: #4F46E5;
        --primary-light: #818CF8;
        --secondary: #8B5CF6;
        --secondary-dark: #7C3AED;
        --success: #10B981;
        --danger: #EF4444;
        --danger-dark: #DC2626;
        --text-primary: #1F2937;
        --text-secondary: #6B7280;
        --text-muted: #9CA3AF;
        --border-color: #E5E7EB;
        --border-light: #F3F4F6;

        /* Shadows */
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
        background-color: var(--cream-bg);
        color: var(--text-primary);
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .profile-container {
        min-height: 100vh;
        padding: 40px 0;
    }

    .container-custom {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .animate-slide-up {
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .animate-input {
        animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    /* Profile Card */
    .profile-card {
        background: var(--white-soft);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-xl);
    }

    /* Profile Header */
    .profile-header {
        position: relative;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 60px 40px;
        overflow: hidden;
    }

    .header-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }

    .bg-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.3;
        animation: float 8s ease-in-out infinite;
    }

    .orb-1 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, transparent 70%);
        top: -100px;
        right: -50px;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        bottom: -80px;
        left: -30px;
        animation-delay: 2s;
    }

    .orb-3 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        top: 50%;
        left: 50%;
        animation-delay: 4s;
    }

    .header-content {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
        text-align: center;
    }

    .avatar-section {
        position: relative;
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
    }

    .avatar-ring {
        position: absolute;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    .avatar-circle {
        width: 120px;
        height: 120px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .profile-card:hover .avatar-circle {
        transform: scale(1.05) rotate(5deg);
    }

    .avatar-text {
        font-size: 48px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .user-info {
        color: white;
    }

    .user-name {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .user-email {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 16px;
        opacity: 0.95;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .user-email i {
        font-size: 18px;
    }

    .user-role {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .user-role:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    /* Profile Body */
    .profile-body {
        padding: 40px;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    /* Section Card */
    .section-card {
        background: #F9FAFB;
        border-radius: 20px;
        padding: 32px;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-light);
    }

    .section-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .section-card:hover .section-icon {
        transform: rotate(10deg) scale(1.05);
    }

    .icon-password {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--secondary) 100%);
    }

    .icon-danger {
        background: linear-gradient(135deg, var(--danger-dark) 0%, var(--danger) 100%);
    }

    .section-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.01em;
    }

    /* Form Styles */
    .form-content {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .form-label i {
        color: var(--primary);
        font-size: 16px;
    }

    .input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 15px;
        font-weight: 500;
        color: var(--text-primary);
        background: white;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        font-family: 'Outfit', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        transform: translateY(-2px);
    }

    .form-input::placeholder {
        color: var(--text-muted);
    }

    .input-underline {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 0;
        background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 3px;
        transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .form-input:focus+.input-underline {
        width: 100%;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 16px;
    }

    .btn-primary,
    .btn-secondary,
    .btn-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 32px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
        font-family: 'Outfit', sans-serif;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-dark) 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(139, 92, 246, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger) 0%, var(--danger-dark) 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(239, 68, 68, 0.4);
    }

    .btn-primary:active,
    .btn-secondary:active,
    .btn-danger:active {
        transform: translateY(-1px);
    }

    /* Danger Zone */
    .section-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        border: 2px solid #FCA5A5;
    }

    .danger-zone {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .danger-info {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        flex: 1;
        min-width: 300px;
    }

    .danger-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #FCA5A5 0%, #F87171 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        flex-shrink: 0;
    }

    .danger-text {
        flex: 1;
    }

    .danger-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--danger-dark);
        margin-bottom: 6px;
    }

    .danger-desc {
        font-size: 14px;
        color: #991B1B;
        font-weight: 500;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
            padding: 20px 0;
        }

        .profile-header {
            padding: 40px 24px;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
        }

        .avatar-text {
            font-size: 40px;
        }

        .user-name {
            font-size: 24px;
        }

        .user-email {
            font-size: 14px;
        }

        .profile-body {
            padding: 24px;
            gap: 24px;
        }

        .section-card {
            padding: 24px;
        }

        .section-title {
            font-size: 18px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .danger-zone {
            flex-direction: column;
            align-items: stretch;
        }

        .danger-info {
            min-width: 100%;
        }

        .btn-danger {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .header-content {
            gap: 20px;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
        }

        .avatar-text {
            font-size: 32px;
        }

        .user-name {
            font-size: 20px;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add focus animations to inputs
        const inputs = document.querySelectorAll('.form-input');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const formGroup = this.closest('.form-group');
                formGroup.style.transform = 'translateY(-4px)';
            });

            input.addEventListener('blur', function() {
                const formGroup = this.closest('.form-group');
                formGroup.style.transform = 'translateY(0)';
            });
        });

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endsection