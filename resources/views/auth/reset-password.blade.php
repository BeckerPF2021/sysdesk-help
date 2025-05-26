<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Reset Password') }}</title>
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

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
            outline: none;
        }

        .input-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
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
    </style>
</head>
<body>

    <div class="login-container">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus />
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-top: 1.25rem;">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div style="margin-top: 1.25rem;">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">
                {{ __('Reset Password') }}
            </button>
        </form>
    </div>

</body>
</html>
