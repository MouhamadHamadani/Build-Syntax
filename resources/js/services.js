// Alpine component for the Services page sub-navigation.
// Registered on `alpine:init`, which Livewire fires after this module has run.
document.addEventListener('alpine:init', () => {
    // Marks the link of the section that is in view (the band between 30% and 40% from the top).
    Alpine.data('subnav', (ids) => ({
        active: null,
        observer: null,

        init() {
            if (!('IntersectionObserver' in window)) return;

            this.observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) this.active = entry.target.id;
                    });
                },
                { rootMargin: '-30% 0px -60% 0px' }
            );

            ids.forEach((id) => {
                const section = document.getElementById(id);
                if (section) this.observer.observe(section);
            });
        },

        destroy() {
            this.observer?.disconnect();
        },
    }));
});
