<x-guest-layout>
    <x-slot name="title">Two-step sign-in</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }" class="grid gap-5">
            <div>
                <h1 class="text-[28px] font-bold">{{ __('Two-step sign-in') }}</h1>

                <p class="mt-2 text-[15px] text-dark-muted" x-show="! recovery">
                    {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                </p>

                <p class="mt-2 text-[15px] text-dark-muted" x-cloak x-show="recovery">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('two-factor.login') }}" class="grid gap-5">
                @csrf

                <div class="field" x-show="! recovery">
                    <x-label for="code" value="{{ __('Code') }}" />
                    <x-input id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    <x-input-error for="code" />
                </div>

                <div class="field" x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    <x-input-error for="recovery_code" />
                </div>

                <x-button class="w-full !py-[15px] !text-[16px]">{{ __('Sign in') }}</x-button>

                <button type="button" class="admin-link cursor-pointer text-center text-sm"
                        x-show="! recovery"
                        x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                    {{ __('Use a recovery code') }}
                </button>

                <button type="button" class="admin-link cursor-pointer text-center text-sm"
                        x-cloak
                        x-show="recovery"
                        x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                    {{ __('Use an authentication code') }}
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
