{{-- Split sign-in layout: brand panel on the left (logo only below 1024px), the form on the right. --}}
<div class="flex min-h-screen flex-col lg:flex-row">
    <div class="flex flex-col justify-between gap-10 border-b border-dark-line bg-dark-sidebar px-6 py-6 lg:w-1/2 lg:border-b-0 lg:border-r lg:px-16 lg:py-14">
        {{ $logo ?? '' }}

        <div class="hidden lg:block">
            <p class="font-mono text-[12px] font-medium uppercase tracking-[.12em] text-brand-blue-light">Admin</p>
            <p class="heading mt-3.5 max-w-[14ch] text-[44px] font-extrabold">Everything behind the site, in one place.</p>
            <p class="mt-[18px] max-w-[44ch] text-[17px] text-dark-muted">Reply to enquiries, publish posts, add projects and keep prices up to date.</p>
        </div>

        <ul class="hidden flex-wrap gap-2.5 lg:flex" aria-label="Products">
            <li class="rounded-lg border border-dark-line px-3 py-2 font-mono text-[12px] font-medium text-saffron">CarteNex</li>
            <li class="rounded-lg border border-dark-line px-3 py-2 font-mono text-[12px] font-medium text-emerald">ShopNex</li>
            <li class="rounded-lg border border-dark-line px-3 py-2 font-mono text-[12px] font-medium text-tymelo">Tymelo</li>
            <li class="rounded-lg border border-dark-line px-3 py-2 font-mono text-[12px] font-medium text-terracotta">LebaSouk POS</li>
        </ul>
    </div>

    <main id="main" class="flex flex-1 items-center justify-center px-6 py-10 lg:px-6 lg:py-14">
        <div class="grid w-full max-w-[400px] gap-5">
            {{ $slot }}
        </div>
    </main>
</div>
