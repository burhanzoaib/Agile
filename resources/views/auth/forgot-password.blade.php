<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sew & Grew</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('public/assets') }}/dist/css/adminlte.min.css?v=3.2.0">
<body class="hold-transition login-page">
            <div class="login-box">

                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="#" class="h1"><b>Sew</b>Grew</a>
                    </div>

                    

                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <p class="login-box-msg">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                               

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block"> {{ __('Email Password Reset Link') }}</button>
                                </div>

                            </div>
                        </form>
                       

                        
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

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>--}}
