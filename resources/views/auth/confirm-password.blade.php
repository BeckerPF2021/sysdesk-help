<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Confirm Password') }}</title>
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
            display: block;
            margin-bottom: 0.25rem;
            color: #374151;
        }
        input[type="password"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1.5px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }
        input[type="password"]:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
        .mt-2 {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        button.button {
            background-color: #6366f1;
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            user-select: none;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.4);
        }
        button.button:hover,
        button.button:focus {
            background-color: #4338ca;
            outline: none;
            box-shadow: 0 0 8px rgba(67, 56, 202, 0.7);
        }
        .flex {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        .text-info {
            margin-bottom: 1.25rem;
            color: #4b5563;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="text-info">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex">
                <button type="submit" class="button">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>

</body>
</html>
