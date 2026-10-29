// Alpine components for the home page.
// Livewire bundles Alpine and starts it on DOMContentLoaded, after this module has run,
// so registering on `alpine:init` is early enough.
document.addEventListener('alpine:init', () => {
    // Hero showcase: tabs + crossfading slides. Auto-advances every 5 s until the
    // visitor picks a tab (click or arrow keys); never auto-advances with reduced motion.
    Alpine.data('showcase', (count) => ({
        active: 0,
        timer: null,

        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            this.timer = setInterval(() => {
                this.active = (this.active + 1) % count;
            }, 5000);
        },

        destroy() {
            this.stop();
        },

        stop() {
            clearInterval(this.timer);
            this.timer = null;
        },

        select(index) {
            this.stop();
            this.active = index;
        },

        // Arrow keys / Home / End move to a tab and activate it (WAI-ARIA tabs pattern).
        move(index) {
            this.select((index + count) % count);
            this.$refs.tablist.querySelectorAll('[role="tab"]')[this.active].focus();
        },
    }));

    // "Copy" button next to a phone number or email.
    Alpine.data('copyButton', (text) => ({
        label: 'Copy',

        async copy() {
            try {
                await navigator.clipboard.writeText(text);
            } catch (e) {
                this.label = 'Select text';
                return;
            }

            this.label = 'Copied';
            setTimeout(() => (this.label = 'Copy'), 1500);
        },
    }));
});
