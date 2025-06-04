<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Login') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: #1a1a2e;
            background: linear-gradient(135deg,rgb(95, 119, 228) 0%,rgb(18, 53, 209) 50%,rgb(147, 204, 251) 100%);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 
                0 25px 45px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05);
            max-width: 420px;
            width: 100%;
            z-index: 2;
            position: relative;
        }

        .login-title {
            text-align: center;
            margin-bottom: 2rem;
            color: white;
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .login-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            z-index: 1;
        }

        label {
            font-weight: 600;
            color: white;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            backdrop-filter: blur(10px);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        input:focus {
            border-color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .input-error {
            color: rgb(107, 159, 255);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            background: rgba(255, 107, 107, 0.1);
            padding: 0.5rem;
            border-radius: 8px;
            border-left: 3px solid rgb(107, 122, 255);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 0.5rem;
        }

        .remember-me input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            accent-color: #667eea;
        }

        .remember-me label {
            margin-left: 0.75rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .forgot-password {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        button[type="submit"] {
            background: linear-gradient(135deg, #667eea,rgb(52, 50, 175));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 120px;
            transition: all 0.3s ease;
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .session-status {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            button[type="submit"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="login-container" role="main" aria-label="Login form">
        <h1 class="login-title">{{ __('Login') }}</h1>
        <p class="login-subtitle">{{ __('Faça o Login no SysDesk') }}</p>

        <x-auth-session-status class="session-status" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="input-group">
                <label for="email">{{ __('E-mail') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="usuario@example.com" autocomplete="username" aria-describedby="email-error" />
                <i class="fa fa-envelope"></i>
                @error('email')
                    <span class="input-error" id="email-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">{{ __('Senha') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" aria-describedby="password-error" />
                <i class="fa fa-lock"></i>
                @error('password')
                    <span class="input-error" id="password-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember" />
                <label for="remember_me">{{ __('Lembrar-me') }}</label>
            </div>

            <div class="actions">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif
                <button type="submit">{{ __('Entrar') }}</button>
            </div>
        </form>
    </main>
</body>
</html>
