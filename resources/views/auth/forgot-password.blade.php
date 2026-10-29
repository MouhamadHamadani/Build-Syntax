<x-guest-layout>
    <x-slot name="title">Forgot your password?</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <h1 class="text-[28px] font-bold">{{ __('Forgot your password?') }}</h1>
            <p class="mt-2 text-[15px] text-dark-muted">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

        @session('status')
            <div role="status" class="flash flash-success">{{ $value }}</div>
        @endsession

        <form method="POST" action="{{ route('password.email') }}" class="grid gap-5">
            @csrf

            <div class="field">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error for="email" />
            </div>

            <x-button class="w-full !py-[15px] !text-[16px]">{{ __('Email Password Reset Link') }}</x-button>

            <a class="admin-link text-center text-sm" href="{{ route('login') }}">{{ __('Back to sign in') }}</a>
        </form>
    </x-authentication-card>
</x-guest-layout>
