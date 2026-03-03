<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FEFDFD;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background elements */
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #D26D6B 0%, #C9B6C7 100%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            opacity: 0.1;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #777292 0%, #C9B6C7 100%);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            opacity: 0.1;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(22, 15, 26, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .register-card:hover {
            box-shadow: 0 30px 80px rgba(22, 15, 26, 0.12);
            transform: translateY(-4px);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #160F1A;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #777292;
            font-size: 15px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #160F1A;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e8e4ea;
            border-radius: 12px;
            font-size: 15px;
            color: #160F1A;
            background: #FEFDFD;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-input:focus {
            border-color: #777292;
            box-shadow: 0 0 0 4px rgba(119, 114, 146, 0.1);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #C9B6C7;
        }

        .error-message {
            color: #D26D6B;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            animation: shake 0.3s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-footer {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 32px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #D26D6B 0%, #C9B6C7 100%);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            box-shadow: 0 8px 24px rgba(210, 109, 107, 0.3);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
        }

        .login-link a {
            color: #777292;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #777292, #D26D6B);
            transition: width 0.3s ease;
        }

        .login-link a:hover {
            color: #160F1A;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e8e4ea;
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-strength.active {
            opacity: 1;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #D26D6B;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #C9B6C7;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #777292;
        }

        .password-hint {
            font-size: 12px;
            color: #777292;
            margin-top: 6px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-hint.active {
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .register-card {
                padding: 36px 28px;
                border-radius: 20px;
            }

            .header h1 {
                font-size: 28px;
            }

            .header p {
                font-size: 14px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            body::before,
            body::after {
                display: none;
            }
        }

        @media (max-width: 400px) {
            .register-card {
                padding: 28px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .form-input {
                padding: 12px 16px;
                font-size: 14px;
            }

            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }

        /* Loading animation for buttons */
        .btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Focus visible for accessibility */
        .btn:focus-visible,
        .form-input:focus-visible {
            outline: 3px solid #777292;
            outline-offset: 2px;
        }

        /* Form animation on load */
        .form-group {
            animation: slideInUp 0.5s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-footer {
            animation: slideInUp 0.5s ease forwards 0.5s;
            opacity: 0;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="register-card">
        <div class="header">
            <h1>Create Account</h1>
            <p>Sign up to get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input
                    class="form-input"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Enter your full name"
                />
                @error('name') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input
                    class="form-input"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Enter your email"
                />
                @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <!-- Kelas -->
            <div class="form-group">
                <label class="form-label">Pilih Kelas</label>
                <select name="sm_class_id" class="form-input" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($classes as $class)
                        <option
                            value="{{ $class->id }}"
                            {{ old('sm_class_id') == $class->id ? 'selected' : '' }}
                        >
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                @error('sm_class_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Posisi -->
            <div class="form-group">
                <label class="form-label">Posisi</label>
                <select name="role" class="form-input" required>
                    <option value="">-- Pilih Posisi --</option>
                    <option value="ketua_kelas" {{ old('role') == 'ketua_kelas' ? 'selected' : '' }}>
                        Ketua Kelas
                    </option>
                    <option value="anggota" {{ old('role') == 'anggota' ? 'selected' : '' }}>
                        Anggota
                    </option>
                </select>
                <small class="password-hint">
                    Ketua kelas hanya boleh satu orang per kelas
                </small>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <input
                    class="form-input"
                    type="password"
                    name="password"
                    required
                    placeholder="Create a password"
                />
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input
                    class="form-input"
                    type="password"
                    name="password_confirmation"
                    required
                    placeholder="Confirm your password"
                />
            </div>

            <!-- Footer -->
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>

                <div class="login-link">
                    <a href="{{ route('login') }}">
                        Already registered? Login here
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

    <script>
        // Add smooth loading state to submit button
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Creating account...';
        });

        // Add smooth focus animations
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.form-label').style.color = '#777292';
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.querySelector('.form-label').style.color = '#160F1A';
                }
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordStrengthBar = document.getElementById('passwordStrengthBar');
        const passwordHint = document.getElementById('passwordHint');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length === 0) {
                passwordStrength.classList.remove('active');
                passwordHint.classList.remove('active');
                return;
            }

            passwordStrength.classList.add('active');
            passwordHint.classList.add('active');

            // Calculate password strength
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            // Update strength bar
            passwordStrengthBar.className = 'password-strength-bar';
            if (strength <= 1) {
                passwordStrengthBar.classList.add('weak');
                passwordHint.textContent = 'Weak password - add numbers and symbols';
                passwordHint.style.color = '#D26D6B';
            } else if (strength <= 2) {
                passwordStrengthBar.classList.add('medium');
                passwordHint.textContent = 'Medium password - add more complexity';
                passwordHint.style.color = '#C9B6C7';
            } else {
                passwordStrengthBar.classList.add('strong');
                passwordHint.textContent = 'Strong password!';
                passwordHint.style.color = '#777292';
            }
        });

        // Password confirmation matching indicator
        const confirmPasswordInput = document.getElementById('password_confirmation');
        
        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;

            if (confirmPassword.length === 0) {
                this.style.borderColor = '#e8e4ea';
                return;
            }

            if (password === confirmPassword) {
                this.style.borderColor = '#777292';
            } else {
                this.style.borderColor = '#D26D6B';
            }
        });

        confirmPasswordInput.addEventListener('blur', function() {
            if (this.value.length > 0) {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                
                if (password !== confirmPassword) {
                    this.style.borderColor = '#D26D6B';
                } else {
                    this.style.borderColor = '#777292';
                }
            } else {
                this.style.borderColor = '#e8e4ea';
            }
        });
    </script>
</body>
</html>