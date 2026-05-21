import './bootstrap';

// ---------------------------------------------------------------------------
// Scroll-triggered fade-in
// Replaces the previous "fires on page-load for everything" behaviour.
// Elements with `.fade-in` start invisible and animate in only when they
// actually enter the viewport. Re-runs after Livewire navigation so newly
// rendered content also gets observed.
// ---------------------------------------------------------------------------

const initFadeInObserver = () => {
    // No IntersectionObserver support → reveal everything immediately.
    if (typeof IntersectionObserver === 'undefined') {
        document.querySelectorAll('.fade-in').forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -10% 0px', threshold: 0.05 }
    );

    document.querySelectorAll('.fade-in:not(.is-visible)').forEach((el) => observer.observe(el));
};

document.addEventListener('DOMContentLoaded', initFadeInObserver);
document.addEventListener('livewire:navigated', initFadeInObserver);

