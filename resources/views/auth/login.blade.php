<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            max-width: 450px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(22, 15, 26, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-card:hover {
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

        .status-message {
            background: linear-gradient(135deg, #C9B6C7 0%, #D26D6B 100%);
            color: white;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            text-align: center;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .checkbox-container {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }

        .checkbox-input {
            width: 20px;
            height: 20px;
            border: 2px solid #777292;
            border-radius: 6px;
            cursor: pointer;
            accent-color: #777292;
            transition: all 0.3s ease;
        }

        .checkbox-input:checked {
            background: #777292;
        }

        .checkbox-label {
            margin-left: 10px;
            color: #777292;
            font-size: 14px;
            cursor: pointer;
            user-select: none;
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
            background: linear-gradient(135deg, #160F1A 0%, #777292 100%);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            box-shadow: 0 8px 24px rgba(22, 15, 26, 0.3);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #D26D6B 0%, #C9B6C7 100%);
            color: white;
            flex: 1;
        }

        .btn-secondary:hover {
            box-shadow: 0 8px 24px rgba(210, 109, 107, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: #777292;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-password a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #777292, #D26D6B);
            transition: width 0.3s ease;
        }

        .forgot-password a:hover {
            color: #160F1A;
        }

        .forgot-password a:hover::after {
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .login-card {
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
            .login-card {
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
        .form-input:focus-visible,
        .checkbox-input:focus-visible {
            outline: 3px solid #777292;
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="header">
                <h1>Welcome Back</h1>
                <p>Please login to your account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        id="email" 
                        class="form-input" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Enter your email"
                    />
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        id="password" 
                        class="form-input"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    />
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-container">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="checkbox-input" 
                        name="remember"
                    />
                    <label for="remember_me" class="checkbox-label">Remember me</label>
                </div>

                <!-- Buttons -->
                <div class="form-footer">
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">
                            Log In
                        </button>
                        <a href="/register" class="btn btn-secondary">
                            Register
                        </a>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add smooth loading state to submit button
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Logging in...';
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
    </script>
</body>
</html>