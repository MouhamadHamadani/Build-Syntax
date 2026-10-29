<x-guest-layout>
    <x-slot name="title">Verify your email</x-slot>

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <h1 class="text-[28px] font-bold">{{ __('Verify your email') }}</h1>
            <p class="mt-2 text-[15px] text-dark-muted">{{ __("Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div role="status" class="flash flash-success">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-button type="submit" class="w-full !py-[15px] !text-[16px]">{{ __('Resend Verification Email') }}</x-button>
        </form>

        <div class="flex items-center justify-center gap-4 text-sm">
            <a href="{{ route('profile.show') }}" class="admin-link">{{ __('Edit Profile') }}</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="admin-link cursor-pointer">{{ __('Log Out') }}</button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
