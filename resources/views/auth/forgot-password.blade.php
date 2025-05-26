<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Forgot Password') }}</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background-image: url('/images/fundo.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 0.25rem;
        }

        input[type="email"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="email"]:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
            outline: none;
        }

        .input-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .session-status {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        button[type="submit"] {
            background-color: #6366f1;
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            background-color: #4338ca;
        }

        .info-text {
            font-size: 0.875rem;
            color: #4b5563;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

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

            <!-- Email -->
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
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
