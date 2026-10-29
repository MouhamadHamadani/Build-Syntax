<x-guest-layout>
    <x-slot name="title">Confirm your password</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <h1 class="text-[28px] font-bold">{{ __('Confirm your password') }}</h1>
            <p class="mt-2 text-[15px] text-dark-muted">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="grid gap-5">
            @csrf

            <div class="field">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                <x-input-error for="password" />
            </div>

            <x-button class="w-full !py-[15px] !text-[16px]">{{ __('Confirm') }}</x-button>
        </form>
    </x-authentication-card>
</x-guest-layout>
