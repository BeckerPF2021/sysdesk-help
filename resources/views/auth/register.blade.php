<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Register') }}</title>
    <style>
        /* Reset básico */
        *, *::before, *::after {
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


        /* Container com vidro fosco */
        .login-container {
            background: rgba(255 255 255 / 0.15);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            padding: 2.5rem 3rem;
            max-width: 420px;
            width: 100%;
            color: #f1f5f9;
            border: 1px solid rgba(255 255 255 / 0.3);
        }

        /* Labels */
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.5rem;
            color: #e0e7ff;
        }

        /* Inputs */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            background: rgba(255 255 255 / 0.3);
            color: white;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        }

        input::placeholder {
            color: rgba(255 255 255 / 0.7);
        }

        input:focus {
            outline: none;
            background: rgba(255 255 255 / 0.5);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.6);
            color: #1e293b;
        }

        /* Erros */
        .mt-2 {
            color: #f87171; /* vermelho claro */
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Botão */
        button.button {
            background: linear-gradient(90deg, #6366f1, #3b82f6);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
            user-select: none;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.5);
        }

        button.button:hover,
        button.button:focus {
            background: linear-gradient(90deg, #4f46e5, #2563eb);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.7);
            outline: none;
            transform: translateY(-2px);
        }

        /* Link */
        .link {
            font-size: 0.9rem;
            color: #cbd5e1;
            text-decoration: underline;
            user-select: none;
            cursor: pointer;
            align-self: center;
            transition: color 0.3s;
        }

        .link:hover {
            color: #93c5fd;
        }

        form > div {
            margin-bottom: 1.25rem;
        }

        /* Flex container para botão + link */
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        /* Responsividade simples */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                max-width: 100%;
                border-radius: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex">
                <a class="link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button type="submit" class="button">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>
