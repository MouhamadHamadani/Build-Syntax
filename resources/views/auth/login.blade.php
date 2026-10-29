<x-guest-layout>
    <x-slot name="title">Sign in</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <h1 class="text-[28px] font-bold">{{ __('Sign in') }}</h1>
            <p class="mt-2 text-[15px] text-dark-muted">{{ __('Use your admin email and password.') }}</p>
        </div>

        @session('status')
            <div role="status" class="flash flash-success">{{ $value }}</div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="grid gap-5">
            @csrf

            <div class="field">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error for="email" />
            </div>

            <div class="field">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error for="password" />
            </div>

            <div class="flex items-center justify-between gap-3 text-sm">
                <label for="remember_me" class="flex items-center gap-2 text-dark-soft">
                    <x-checkbox id="remember_me" name="remember" />
                    {{ __('Keep me signed in') }}
                </label>

                @if (Route::has('password.request'))
                    <a class="admin-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <x-button class="w-full !py-[15px] !text-[16px]">{{ __('Sign in') }}</x-button>

            <p class="auth-note">{{ __('If two-step sign-in is on for your account, you will be asked for a code next. There is no public sign-up: new admin accounts are added by the owner.') }}</p>
        </form>
    </x-authentication-card>
</x-guest-layout>
