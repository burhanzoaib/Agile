<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agile Tourism</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets') }}/dist/css/adminlte.min.css?v=3.2.0">

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{getLogoUrl()}}" alt="SewandGrew" width="200">
            </div>
            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div class="alert alert-light" role="alert">Sign in to start your session</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" class="form-control " type="email" name="email" :value="old('email')"
                            placeholder="Email" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password" placeholder="Password"
                            required autocomplete="current-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <!-- @if (Route::has('password.email'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.email') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif -->
                </p>
                <p class="mb-0">
                    <!-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="">
                        {{ __('Register') }}
                    </a>
                    @endif -->
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/assets') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('public/assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/assets') }}/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>


{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <form method="POST" action="{{ route('login') }}">
@csrf
<div>
    <x-label for="email" :value="__('Email')" />

    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
</div>
<div class="mt-4">
    <x-label for="password" :value="__('Password')" />

    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="current-password" />
</div>
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            name="remember">
        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>
<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.email'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.email') }}">
        {{ __('Forget Password!') }}
    </a>
    @endif
</div>
<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
        {{ __('For Register!') }}
    </a>
    @endif

    <x-button class="ml-3">
        {{ __('Log in') }}
    </x-button>
</div>
</form>
</x-auth-card>
</x-guest-layout> --}}