<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Register') }}</title>
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
            max-width: 450px;
            width: 100%;
        }

        /* Estilo dos inputs para ficar mais harmonioso */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1.5px solid #d1d5db; /* cinza claro */
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #6366f1; /* roxo */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.25rem;
            color: #374151; /* cinza escuro */
        }

        /* Erro */
        .mt-2 {
            color: #dc2626; /* vermelho */
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Botão primário */
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

        .link {
            font-size: 0.875rem;
            color: #4b5563;
            text-decoration: underline;
            user-select: none;
            cursor: pointer;
            align-self: center;
        }

        form > div {
            margin-bottom: 1rem;
        }

        /* Flex container para botao + link */
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
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
