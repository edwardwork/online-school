@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 py-6">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center">
            <label for="email" class="text-5xl">{{ __('E-Mail Address') }}</label>
            <br>
            <br>
            <input id="email"
                   type="email"
                   class="bg-gray-800 text-4xl rounded-full w-full px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email"
                   autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="text-center mt-8">
            <label for="password" class="text-5xl">{{ __('Password') }}</label>
            <br>
            <br>
            <input id="password"
                   type="password"
                   class="bg-gray-800 text-4xl rounded-full w-full px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
                   name="password"
                   value="{{ old('password') }}"
                   required
                   autocomplete="current-password"
                   autofocus>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="w-full mt-12">
            <button type="submit" class="text-5xl block mx-auto">
                {{ __('Login') }}
            </button>
        </div>
    </form>
</div>

@endsection
