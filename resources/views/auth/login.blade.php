<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Login') }}</title>
    <style>
        /* Fundo com imagem */
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

        /* Container do formulário */
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
            color: #374151; /* gray-700 */
            display: block;
            margin-bottom: 0.25rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db; /* gray-300 */
            border-radius: 0.375rem;
            outline-offset: 2px;
            outline-color: transparent;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6366f1; /* indigo-500 */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
            outline: none;
        }

        .input-error {
            color: #dc2626; /* red-600 */
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            accent-color: #6366f1; /* indigo-500 */
        }

        .remember-me label {
            margin-left: 0.5rem;
            font-size: 0.875rem;
            color: #374151; /* gray-700 */
            cursor: pointer;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-password {
            font-size: 0.875rem;
            color: #6366f1; /* indigo-500 */
            text-decoration: underline;
            cursor: pointer;
        }

        .forgot-password:hover,
        .forgot-password:focus {
            color: #4338ca; /* indigo-700 */
            outline: none;
            text-decoration: none;
        }

        button[type="submit"] {
            background-color: #6366f1; /* indigo-500 */
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-left: 1rem;
        }

        button[type="submit"]:hover,
        button[type="submit"]:focus {
            background-color: #4338ca; /* indigo-700 */
            outline: none;
        }

        /* Session Status */
        .session-status {
            background-color: #d1fae5; /* green-100 */
            border: 1px solid #10b981; /* green-500 */
            color: #065f46; /* green-800 */
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" aria-describedby="email-error" />
                @error('email')
                    <div class="input-error" id="email-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-top: 1.25rem;">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" aria-describedby="password-error" />
                @error('password')
                    <div class="input-error" id="password-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember" />
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <!-- Actions -->
            <div class="actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>

</body>
</html>
