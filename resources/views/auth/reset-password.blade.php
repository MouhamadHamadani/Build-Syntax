<x-guest-layout>
    <x-slot name="title">Reset your password</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <h1 class="text-[28px] font-bold">{{ __('Reset your password') }}</h1>
            <p class="mt-2 text-[15px] text-dark-muted">{{ __('Choose a new password for your account.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="grid gap-5">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-input-error for="token" />

            <div class="field">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error for="email" />
            </div>

            <div class="field">
                <x-label for="password" value="{{ __('New password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error for="password" />
            </div>

            <div class="field">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error for="password_confirmation" />
            </div>

            <x-button class="w-full !py-[15px] !text-[16px]">{{ __('Reset Password') }}</x-button>
        </form>
    </x-authentication-card>
</x-guest-layout>
