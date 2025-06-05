<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Login') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            background: linear-gradient(-45deg, #1d3557, #457b9d, #a8dadc, #f1faee);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
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
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 1;
            }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            color: white;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        input[type="email"],
        input[type="password"] {
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
            <span style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 20) }}s; width: {{ rand(5, 20) }}px; height: {{ rand(5, 20) }}px;"></span>
        @endfor
    </div>

    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" placeholder="you@example.com" required autofocus />
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-top: 1.25rem;">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" placeholder="********" required />
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">
                {{ __('Login') }}
            </button>
        </form>
    </div>
</body>
</html>
