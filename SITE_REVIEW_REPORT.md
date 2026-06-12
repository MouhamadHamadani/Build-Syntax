# Build Syntax — Full Website Review Report

**Date:** June 12, 2026 · **Branch reviewed:** `fix/ga-env-gating` (latest) · **Method:** 4 parallel specialist reviews (Code Auditor, Design & UX, Flow & Conversion, Content & Data), consolidated and re-verified by the PM. All Critical findings were independently re-confirmed against source before publication.

---

## 1. Executive Summary

| Area | Score /10 | One-line verdict |
|---|---|---|
| Code | 6.5 | Solid Livewire architecture and airtight admin routing, dragged down by 3 shippable-blocking bugs and an unprotected newsletter form |
| Design | 6.5 | Disciplined token system and consistent rhythm, undermined by light-theme remnants, contrast failures, and a dated hero |
| UX / Flow | 7.0 | Every product ≤2 clicks from anywhere with relentless contact pull, but conversion leaks at the seams |
| Content | 6.5 | Strong, honest, well-localized services page — but one lead-killing data bug and four cross-page pricing contradictions |
| **Combined** | **6.6** | A genuinely good foundation that is currently leaking leads at the exact moments of highest intent |

### The 3 highest-impact changes

1. **Fix the contact-form database enum** (`project_type` still allows `mobile_app`, not `appointment`/`pos`). Right now **two of your four products cannot generate leads** — every Tymelo and POS Pro contact submission fails at insert on MySQL. This single migration is worth more than everything else in this report combined.
2. **Fix the contact funnel plumbing**: re-bucket budget ranges (current $5k–$30k+ buckets vs a $699–$2,200 catalog makes every lead land in one bucket and signals "we're not for you"), and carry plan context from the ~15 pricing CTAs into the form (`?type=&plan=` prefill) so a buyer who clicked "Get Tymelo Business" doesn't have to re-state what they want.
3. **Give POS Pro and ShopNex parity**: POS Pro is invisible from the home page (3 cards cover only 3 products), and ShopNex — the flagship, listed first — has the plainest section on /services while Tymelo gets a value bar, toggle, add-ons, and 8 FAQs. The richest section reads as "the product they actually care about."

---

## 2. Critical Issues (must fix before/at launch)

### C1 · Tymelo & POS Pro leads fail at the database
- **Files:** `database/migrations/2026_02_24_130135_create_contact_submissions_table.php:20`, `app/Livewire/Pages/Contact.php:28`, `resources/views/livewire/pages/contact.blade.php:101-102`
- **Why it matters:** The DB column is `enum('website','ecommerce','mobile_app','other')` but the form (and validation) now submit `appointment` and `pos`. On MySQL every such submission throws at insert; the visitor sees a generic error at the exact moment they tried to buy. Sprint 3 Task 4 fixed the form layer but missed the schema.
- **Fix:** One migration: change the enum to `('website','ecommerce','appointment','pos','other')` — or convert the column to `string` and let validation own the whitelist (more future-proof). Also update the label map in `app/Notifications/NewContactSubmission.php:26-31` (still has `mobile_app`, lacks the two new types) so admin lead emails don't print raw keys.
- **Effort:** S

### C2 · Blog admin can hang the server with one duplicate title
- **File:** `app/Models/BlogPost.php:47-52`
- **Why it matters:** The slug-uniqueness loop regenerates the *identical* slug each iteration (`while (exists) { $slug = Str::slug($blog->title); }`) — creating a post whose title slugifies to an existing slug spins forever until PHP timeout.
- **Fix:** Append an incrementing suffix inside the loop (`$slug = $base.'-'.$i++`).
- **Effort:** S

### C3 · Admin portfolio Edit page 500s on any project without URLs
- **File:** `app/Livewire/Admin/Portfolio/Edit.php:13-18, 39-40`
- **Why it matters:** `public string $project_url` / `$image_url` are non-nullable typed properties assigned raw model values in `mount()`, but Create stores empty URLs as `null` → `TypeError`, edit page dead for those rows.
- **Fix:** `?? ''` on assignment (or make the properties nullable). While in the file: the layout title says "New Project" on the edit screen.
- **Effort:** S

### C4 · Every portfolio image renders broken
- **Files:** `resources/views/livewire/pages/portfolio.blade.php:71, 221`; contract mismatch with `app/Livewire/Admin/Portfolio/Create.php:25`
- **Why it matters:** Admin validates `image_url` as an absolute `url`, but the public view wraps it in `Storage::url()` → `/storage/https://…`. The moment you add real portfolio projects (a launch prerequisite per Sprint 3), every image 404s — on the page meant to prove you can build websites.
- **Fix:** Pick one contract. Simplest: print the URL raw (`{{ $project->image_url }}`) and keep `url` validation. Same dormant pattern exists for blog `featured_image`.
- **Effort:** S–M

### C5 · Privacy Policy became inaccurate the day GA shipped
- **Files:** `resources/views/livewire/pages/privacy-policy.blade.php:50-66` vs `resources/views/layouts/app.blade.php:46-61`
- **Why it matters:** Policy says data is stored only on Build Syntax servers and hedges "may use analytics cookies" — GA4 is now live in production, sending visitor data to Google via `_ga` cookies. An inaccurate privacy policy is a trust and legal-exposure issue for an agency selling professionalism.
- **Fix:** Name Google Analytics explicitly in §5 (note IP anonymization is enabled), add Google as a third-party processor in §4, bump "Last updated."
- **Effort:** S

---

## 3. High & Medium Issues

### Code

| # | Sev | Issue | File(s) | Fix | Effort |
|---|---|---|---|---|---|
| H1 | High | Newsletter form has no rate limiting or honeypot; every submit fires a confirmation email (mail-bombing + email enumeration via `unique:` rule) | `app/Livewire/Components/NewsletterSubscribe.php:17-42` | Mirror Contact's `RateLimiter` block (3/5min/IP); generic "check your email" response | S |
| H2 | High | `is_admin` is mass-assignable while Jetstream public registration is enabled — latent privilege-escalation; a brochure site doesn't need signups | `app/Models/User.php:32`, `config/fortify.php:147` | Remove `is_admin` from `$fillable`; disable `Features::registration()` | S |
| H3 | High | Portfolio category split-brain: DB/admin allow `mobile`, public filter offers `pos` — the "POS Pro" filter can never match anything, admins can only tag a product you don't sell | `database/migrations/2026_02_24_130121…:17`, `app/Livewire/Admin/Portfolio/Create.php:24`, `app/Livewire/Pages/Portfolio.php:65` | Migrate enum `mobile→pos` (consider adding `appointment`); single source of truth (config/enum) for both admin validation and public filter | M |
| M1 | Med | Admin search `orWhere` precedence bug leaks rows across status/priority filters | `app/Livewire/Admin/Contacts/Index.php:26-28`, `Newsletter/Index.php:30-32` | Wrap search in a closure `where(fn($q)=>…)` | S |
| M2 | Med | Admin contact `update()` persists status/priority/notes with zero validation | `app/Livewire/Admin/Contacts/Show.php:25-32` | `in:` rules matching the workflow values + `max:` on notes | S |
| M3 | Med | Editable blog slug lacks unique-except-self + format rules → 500 on duplicate, broken URLs on spaces | `app/Livewire/Admin/Blog/Edit.php:25` | `alpha_dash|unique:blog_posts,slug,{id}` | S |
| M4 | Med | Newsletter `unique:` blocks unsubscribed users from ever resubscribing | `app/Livewire/Components/NewsletterSubscribe.php:17` | Reactivate existing unsubscribed row instead of failing | S |
| M5 | Med | Dead components with weaker security still in tree; `ImageService` calls Intervention v2 API against installed v3 (fatal if invoked) | `app/Livewire/ContactForm.php`, `app/Livewire/NewsletterSubscribe.php`, `app/Livewire/PortfolioGrid.php`, `app/Services/ImageService.php` + 3 orphan views | Delete all | S |
| M6 | Med | No structured data anywhere: no `LocalBusiness`/`Organization`, no `Article` on blog-show, no `FAQPage` — lost local-SEO opportunity for a Beirut agency | `resources/views/layouts/app.blade.php` | JSON-LD partial with per-page overrides via layout slot | M |

### Design

| # | Sev | Issue | File(s) | Fix | Effort |
|---|---|---|---|---|---|
| H4 | High | Login/auth screens are a white Figtree island in a dark Poppins site | `resources/views/layouts/guest.blade.php:11-21` | Poppins + `bg-dark-primary text-dark-accent`, `card-dark` auth card | M |
| H5 | High | `.no-js .fade-in` fallback is dead — the `no-js` class is never on `<html>`, so if JS fails most content stays invisible (`opacity:0`) | `resources/css/app.css:69`, `resources/views/layouts/app.blade.php:2` | Add `class="no-js"` to `<html>`, strip it via 1-line inline head script | S |
| H6 | High | Footer CTA band: full-width flat `bg-brand-blue` slab breaks the dark identity on every page — including Contact, where its button links to the page you're already on | `resources/views/layouts/footer.blade.php:3-21` | Dark band (`gradient-hero-dark` or `card-dark` + `border-brand-blue/30`) with filled+outline button pair; on contact route, swap CTA to WhatsApp | M |
| M7 | Med | Footer uses raw grays (`bg-gray-900`, `text-gray-300`, `border-gray-800`) that visibly mismatch the navy `dark-primary` token | `resources/views/layouts/footer.blade.php:24-107` | Swap to dark tokens | S |
| M8 | Med | Sticky service tabs sit at `top-16` under a ~72px fixed header; anchor sections lack `scroll-mt-*`, so every anchor jump hides the section heading under ~130px of chrome; tabs have no active state | `resources/views/livewire/pages/services.blade.php:17` + the five `<section id=…>` | `top-[72px]`, `scroll-mt-32` on sections, Alpine scroll-spy highlight | S–M |
| M9 | Med | Excluded Tymelo features: `text-gray-600` strikethrough ≈ 2.1:1 contrast — unreadable | `resources/views/livewire/pages/services.blade.php:366-369` | `text-dark-muted/70 line-through` | S |
| M10 | Med | Native `<select>` dropdowns render light UA panels mid-form on Windows | `resources/views/livewire/pages/contact.blade.php:97-120`, `resources/css/app.css` | `color-scheme: dark` on body | S |
| M11 | Med | Portfolio modal: no `role="dialog"`/`aria-modal`/focus trap; icon-only buttons unlabeled; category shows `ucfirst()` ("Pos") instead of the label map | `resources/views/livewire/pages/portfolio.blade.php:197-234` | ARIA attrs + labels; reuse `$categoryLabels` | S |
| M12 | Med | Two near-duplicate "Why Choose" sections on home (and a third copy on services) read templated | `resources/views/livewire/pages/home.blade.php:221-270, 409-468`, `services.blade.php:1163+` | Keep the honest-badges grid; cut the generic 4-icon block from home | S |
| M13 | Med | CTA wording sprawl — six variants across tiers/nav ("Request This Plan", "Get Started", "Request Plan", "Get Tymelo Business", "Get a Custom Quote", "Get a Free Quote"/"Get Started") | `services.blade.php` multiple, `navigation.blade.php:48,73` | Standardize: tiers → "Request This Plan", enterprise → "Get a Custom Quote", nav → "Get a Free Quote" (both breakpoints) | S |
| M14 | Med | Add-ons table crushes at 360px (`overflow-x-auto` but no `min-w`); blog-show meta row overflows | `services.blade.php:497-527`, `blog-show.blade.php:21-47` | `min-w-[640px]` on table; `flex-wrap gap-x-6 gap-y-2` on meta row | S |

### Flow & Conversion

| # | Sev | Issue | File(s) | Fix | Effort |
|---|---|---|---|---|---|
| H7 | High | ~15 pricing CTAs link to bare `route('contact')` — product/tier context discarded, user must re-select and retype; increases abandonment and unqualified leads | `resources/views/livewire/pages/services.blade.php` (all tier CTAs) | Append `?type=…&plan=…`; prefill in `Contact.php` `mount()` | M |
| H8 | High | Budget dropdown buckets (Under $5k → $30k+) vs $699–$2,200 catalog: useless segmentation + mispositioning signal | `resources/views/livewire/pages/contact.blade.php:115-119` | Re-bucket: <$1,000 / $1,000–2,500 / $2,500–5,000 / $5,000+ | S |
| H9 | High | Tymelo FAQ promises "a live demo you can explore" — no demo link exists anywhere | `resources/views/livewire/pages/services.blade.php:~545` | Link a real demo or rewrite to "book a 30-minute walkthrough" → contact | S |
| M15 | Med | POS Pro unreachable from home — 3 service cards cover the other 3 products only | `resources/views/livewire/pages/home.blade.php:157-210` | Add 4th card (purple accent, "From $800", → `services#pos`) or 2×2 grid | M |
| M16 | Med | Custom Web Dev card and hero "View Pricing" link to services *top* (lands on ShopNex), not `#web-development` | `home.blade.php:171, 23` | Add the anchor | S |
| M17 | Med | No WhatsApp card in the contact page's info column — the primary Lebanese channel exists only as a floating button | `resources/views/livewire/pages/contact.blade.php:167-238` | Add a prominent WhatsApp card with prefilled `wa.me` message | S |
| M18 | Med | Product-section asymmetry: Tymelo gets value bar/toggle/add-ons/8 FAQs; ShopNex & Web Dev get bare grids (POS: value bar only). Hurts comparison and makes the flagship look like an afterthought | `services.blade.php:59 vs 243+` | Value bar (orange) + 3–4 FAQs for ShopNex; short FAQ block for Web Dev | M–L |

### Content

| # | Sev | Issue | File(s) | Fix | Effort |
|---|---|---|---|---|---|
| H10 | High | Portfolio SEO description still promises "mobile applications" | `app/Livewire/Pages/Portfolio.php:68` | "custom websites, ShopNex e-commerce stores, and POS Pro systems" | S |
| H11 | High | Contact page email renders `config('mail.from.address')` → literal `hello@example.com` if env unset; three sources of truth for the public email | `contact.blade.php:179-181`, `config/mail.php:114` | Use `config('app.email')` everywhere public | S |
| M19 | Med | Home FAQ says maintenance "starting at $150" — Essential is $79 on services | `home.blade.php:352` vs `services.blade.php:1006` | "$79" | S |
| M20 | Med | Contact FAQ says "6–12 weeks" e-commerce + "3 months free support"; About commits "Free Support: 3 months"; services says 4–14 weeks by tier, 1–3 months support | `contact.blade.php:284-305`, `about.blade.php:295-297` | Align: "4–10 weeks depending on tier", "1–3 months depending on plan" | S |
| M21 | Med | ShopNex copy claims "Laravel 11 / Livewire 3" while home badges + meta say Laravel 12 | `services.blade.php:68` | "Laravel 12" | S |
| M22 | Med | Services SEO description names no products — loses branded-search equity for ShopNex/Tymelo/POS Pro | `app/Livewire/Pages/Services.php:14` | Rewrite naming all four offerings | S |
| M23 | Med | About page "Satisfaction: Guaranteed" — Terms §5 offers only a defect warranty; unbacked contractual claim | `about.blade.php:299-301` | "Defect warranty included" or define the guarantee in Terms | S |
| M24 | Med | Nav shows Portfolio but footer Quick Links comments it out — inconsistent IA (PM ruling: the empty state is a designed conversion rescue, so keep Portfolio visible in **both**) | `navigation.blade.php:27-30` vs `footer.blade.php:54-55` | Uncomment footer Portfolio; consider adding Contact to Quick Links | S |

---

## 4. Quick Wins (< 15 min each)

1. `blog-index.blade.php:75` — `placeholder-dark-secondary` is invisible (same color as bg) → `placeholder-dark-muted`
2. `navigation.blade.php:15` — tagline `text-gray-500` fails WCAG on dark bg → `text-dark-muted`
3. `navigation.blade.php:54` — hamburger: add `aria-label="Toggle menu" :aria-expanded="open"`
4. `navigation.blade.php:38` — phone hidden 768–1024px (`hidden lg:`) → show from `md:`
5. `services.blade.php:68` — "Laravel 11" → "Laravel 12"
6. `home.blade.php:352` — maintenance "from $150" → "$79"
7. `home.blade.php:204` — Tymelo card "From $699" → "From $699 + $49/mo" (avoids bait-feel)
8. `home.blade.php:171` + `:23` — add `#web-development` anchor to Custom Web Dev card + hero "View Pricing"
9. `home.blade.php:472` — newsletter `container w-1/2` crushes on mobile → `w-full max-w-2xl px-6`
10. `services.blade.php` — add `scroll-mt-32` to the five product sections; sticky bar `top-16` → `top-[72px]`
11. `services.blade.php:497` — add-ons table: add `min-w-[640px]`
12. `app/Http/Controllers/SitemapController.php:20-27` — add `/privacy-policy` + `/terms-of-service`; drop blog URLs while blog is nav-hidden; add `Sitemap:` line to `public/robots.txt`
13. `app/Notifications/NewContactSubmission.php:26-31` — update project-type label map (drop `mobile_app`, add Tymelo/POS Pro)
14. `contact.blade.php:50` — "John Doe" placeholder → "Your full name"
15. `footer.blade.php:54-55` — uncomment Portfolio in Quick Links
16. `footer.blade.php:114-155` — delete 40 lines of commented-out jQuery
17. `resources/css/app.css` — add `color-scheme: dark` to body (fixes native select/scrollbar rendering)
18. `services.blade.php:366-369` — excluded-feature contrast → `text-dark-muted/70`
19. `app/Livewire/Admin/Portfolio/Edit.php` — layout title "New Project" → "Edit: {title}"
20. `home.blade.php:420+` — remove stray `text-dark-muted` from `bg-brand-blue` icon circles
21. `about.blade.php:299-301` — soften "Satisfaction: Guaranteed"
22. `app/Livewire/Pages/About.php:14` — drop "team" from meta description until profiles exist

---

## 5. Modernization Roadmap (next sprint — real content or larger effort)

| Item | Files / scope | Why |
|---|---|---|
| Replace hero skeleton-bars mockup with stylized product UI (ShopNex/Tymelo dashboard glimpse, dark + brand-blue) | `home.blade.php:29-47` | The single most dated element; carried over from Sprint 3 Gate 3 backlog |
| ShopNex & Web Dev section parity (value bars, FAQs, possibly comparison strip across products) | `services.blade.php` | Flagship product currently has the plainest section (H/M18) |
| Extract `<x-pricing.card>` + `<x-pricing.feature>` Blade components | `services.blade.php` (1,215 lines) | Removes ~15× duplicated markup and most `{!! !!}` sites (all currently safe internal literals) |
| JSON-LD layer: `LocalBusiness` (home), `Article` (blog-show), `FAQPage` (home/services) | `layouts/app.blade.php` + per-page slots | Local SEO for "web development Beirut" queries (M6) |
| Dark-theme auth screens | `layouts/guest.blade.php` | Brand continuity for admin users (H4) |
| 3–5 real/demo portfolio projects + 2–3 blog articles | content task | Gate 3 carry-over; unblocks restoring Blog nav + makes Portfolio nav link safe |
| Founder/team profile on About | `about.blade.php` | Gate 3 carry-over; About is the weakest trust page |
| Arabic Phase 1 (nav + contact), RTL groundwork | layouts | Gate 3 carry-over; market-fit goal #4 |
| Dedicated `/shopnex`, `/tymelo` landing pages with product SEO | new routes (justified exception) | Gate 3 carry-over; branded-search capture |
| Tymelo live demo instance | infra | Converts the currently-false FAQ promise (H9) into a real asset |

### Sprint 3 cross-reference

| Sprint 3 item | Status |
|---|---|
| Gate 1, Tasks 1–8 (POS section, ShopNex rename, legal pages, contact form types, portfolio filter, tagline, FAQ timeline, nav hiding) | ✅ All shipped — **but** Task 4 (contact types) and Task 5 (portfolio categories) were fixed at the form/UI layer only; the DB enums were missed → now **C1** and **H3** of this report |
| Gate 2, Tasks 9–17 (body bg, mobile phone, dark inputs, USD/LBP, scroll-top, Tymelo h2, section rename, Essential plan, footer socials) | ✅ All shipped |
| Gate 3: product color accents, tech SVG icons | ✅ Shipped |
| Gate 3: hero screenshots, founder bio, mock portfolio, blog articles, Arabic, product landing pages | ⏳ Open — rolled into the Modernization Roadmap above |
| Note | Portfolio nav link was re-enabled (commit `b99fcf5`) ahead of the "2+ projects" condition; acceptable given the designed empty state, but footer must match (M24) |

---

## 6. Per-Page Scorecard

| Page | Code | Design | Flow | Content | Overall | Top issue |
|---|---|---|---|---|---|---|
| Home | 7 | 6 | 7 | 6 | **6.5** | POS Pro missing from service cards; duplicate "Why Choose" sections; $150 FAQ contradiction |
| Services | 5 | 7 | 8 | 8 | **7.0** | 1,215-line monolith; anchor jumps hide headings; CTAs drop plan context; "Laravel 11" |
| Portfolio | 5 | 7 | 8 | 6 | **6.5** | `Storage::url()` breaks every image; category enum split-brain; modal a11y |
| About | 8 | 6 | 6 | 5 | **6.0** | Overpromises ("3 months free support", "Satisfaction Guaranteed"); generic copy; no team |
| Contact | 8 | 7 | 6 | 4 | **6.0** | **C1: Tymelo/POS leads fail at insert**; budget buckets 4× too high; no WhatsApp card |
| Blog index | 7 | 6 | 5 | 6 | **6.0** | Orphaned route with misleading, CTA-less empty state; invisible search placeholder |
| Blog show | 6 | 7 | 6 | 6 | **6.5** | No Article JSON-LD; meta row overflows mobile; view counter counts bots |
| Privacy Policy | 7 | 8 | 8 | 6 | **7.0** | Must disclose Google Analytics (C5); absent from sitemap |
| Terms of Service | 7 | 8 | 8 | 9 | **8.0** | Sitemap omission only — strongest content page |
| Admin (cross-cutting) | 5 | — | — | — | **5.0** | Slug infinite loop (C2); Edit 500 (C3); unvalidated status updates; search filter leak |

---

*Review only — no production code was changed in this pass. Implementation is scoped for the next sprint; recommended order: §2 Criticals → Quick Wins → High → Medium → Roadmap.*
