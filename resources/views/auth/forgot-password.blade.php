<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Forgot Password') }}</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            /* Fundo gradiente animado */
            background: linear-gradient(135deg,rgb(95, 119, 228) 0%,rgb(18, 53, 209) 50%,rgb(147, 204, 251) 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;

            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
            color: white;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.05);
            z-index: 0;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particles span {
            position: absolute;
            display: block;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 1; }
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border-radius: 15px;
            padding: 2rem;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            color: white;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.25rem;
        }

        input[type="email"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }

        .input-error {
            color: #ff6b6b;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .session-status {
            background-color: rgba(16, 185, 129, 0.2);
            border-left: 5px solid #10b981;
            color: #d1fae5;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .info-text {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 1rem;
        }

        button[type="submit"] {
            background: linear-gradient(90deg, #4f46e5, #3b82f6);
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="particles">
        @for ($i = 0; $i < 20; $i++)
            <span style="left: {{ rand(0, 100) }}%; 
                          animation-delay: {{ rand(0, 20) }}s; 
                          width: {{ rand(5, 20) }}px; 
                          height: {{ rand(5, 20) }}px;">
            </span>
        @endfor
    </div>

    <div class="login-container">
        <div class="info-text">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="session-status" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>
    </div>
</body>
</html>
