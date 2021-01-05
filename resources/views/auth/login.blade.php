
@extends('index')

@section('title', 'Main page')

@section('main')
<div class=" container w-25 mb-4 mt-5">
    <form method="POST" action="{{ route('login') }}" class="border border-top-0 border-secondary rounded-bottom p-5">
        @csrf

        <div class="form-group d-flex flex-column align-items-center">
            <label for="login">{{ __('Login') }} </label>
            <input id="login" class="form-control w-50" type="login" name="login" required autofocus />
        </div>

        <div class="form-group d-flex flex-column align-items-center">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="form-control w-50" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="form-group d-flex flex-column align-items-center">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="form-group d-flex flex-column align-items-center">

            <button class="btn btn-primary btn-lg">
                {{ __('Login') }}
            </button>
        </div>
    </form>
</div>
@endsection
        
