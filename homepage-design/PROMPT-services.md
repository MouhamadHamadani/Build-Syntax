# Prompt for Claude Code: apply the new Services page design

Run this AFTER the homepage prompt (`PROMPT.md`) has been applied and merged or checked out. Paste everything below the line into Claude Code, opened in the Build-Syntax repo root.

---

You are working in the Build Syntax Laravel repo (Laravel 12, Livewire 3, Tailwind 3.4, Alpine.js, Vite). The homepage redesign is already in place: new tokens in `tailwind.config.js` and `resources/css/app.css`, the new header and footer, and `config/catalog.php`. Your job is to rebuild the Services & Pricing page to match the approved design. Work on a new branch `redesign/services` created from the homepage branch. Do not push, merge or deploy.

If `config/catalog.php` or the homepage tokens do not exist, stop and say so. Do not recreate them.

## 1. The design

`homepage-design/services-reference.html` is the approved design as a static page. It is the source of truth for layout, spacing, type, colours, copy and prices. Open it at 1440px and 390px before you write code. Like the homepage reference, it has light and dark theme code: implement dark only. Its links point to `contact.html` and `index.html`; in Laravel use the named routes. Assets are the same as the homepage: `public/images/brand/` (already copied).

Do not touch the homepage view, admin, auth, migrations, models, routes, `.env`.

## 2. Scope

1. `resources/views/livewire/pages/services.blade.php`: rewrite to match the reference.
2. `app/Livewire/Pages/Services.php`: update the meta title and description (see section 5).
3. `config/catalog.php`: extend it so every plan, price, feature list, hosting tier and maintenance plan on the Services page lives in config, and the page renders from it with `@foreach`, always through the `Catalog` class (section 5a), never by calling `config()` in the view. The homepage cards and the Services page must read the same prices from the same place, so a price is only ever edited once. Keep the existing keys the homepage uses. Do NOT put any of this in `config/products.php`; that file is the contact and portfolio taxonomy and stays as it is.
4. `resources/css/app.css`: add small component classes for what is new (sub-nav, pricing card, terms strip). Reuse the homepage classes and tokens where they already exist. No inline `<style>` blocks, no new JS libraries.

## 3. Page structure (same order as the reference)

1. Hero: eyebrow, `h1` ("Every price on one page."), lead, and the four-cell terms strip.
2. Sticky sub-navigation with anchors `#cartenex`, `#shopnex`, `#tymelo`, `#pos`, `#web-development`, `#hosting`. It sticks directly under the real header, so use the real header's height (do not hard-code the reference's 61px), highlights the section in view with an Alpine component (IntersectionObserver), scrolls sideways on mobile without a visible scrollbar, and has `scroll-margin-top` on every section so headings are not hidden.
3. Four product sections: CarteNex (3 plans), ShopNex (3), Tymelo (2), LebaSouk POS (3, Premium is "Contact us").
4. Custom development: Starter From $800, Professional From $1,500, Enterprise custom quote.
5. Hosting (3 yearly tiers) and monthly maintenance (4 plans).
6. Closing contact block with WhatsApp `https://wa.me/9613876822`, `+961 3 876 822`, `info@build-syntax.com`, each with a Copy button (Alpine, with a fallback when the clipboard API fails).

Anchors: the old page used `#ecommerce`, `#menus`, `#appointment`, `#pos`, `#web-development`, `#hosting`. Search all of `resources/views` for `services#` and `/services#`, update every link to the new ids, and keep the old ids working for outside links by adding invisible `<span id="ecommerce"></span>`, `<span id="menus"></span>` and `<span id="appointment"></span>` anchors just above the matching new sections.

## 4. Behaviour and quality rules

- Every plan button uses `route('contact', ['type' => <type>, 'plan' => <plan name>])`. `Contact.php` already reads both and validates `type` against `config('products.project_types')`, so use only these types: `cartenex`, `ecommerce` (ShopNex), `appointment` (Tymelo), `pos` (LebaSouk), `website` (custom development), `other` (hosting and maintenance). The plan value must match `^[A-Za-z0-9][A-Za-z0-9 _.\-]{0,49}$`. Check each link by clicking it and confirming the form shows the right project type and the message "I'm interested in the {plan} plan."
- Use the reference copy and prices word for word. Do not add claims. Some features were removed on purpose because they are not built or not safe to promise. Specifically do NOT re-add: "POS Pro", "Early access / Beta", "No monthly SaaS fees" as an icon bar for the old POS, "99.9% uptime SLA", "Quality Guaranteed", "On-Time Delivery", "Dedicated Support" cards, or "50% deposit, 30%, 20% for all packages". Payment terms are per product, as in the reference.
- All content above the fold is visible at rest: no `.fade-in` on the hero or the sub-nav. `.fade-in` is fine further down.
- Accessibility: one `h1`, headings in order (section `h2`, plan `h3`), the sub-nav is a `<nav aria-label>` with a list of links, visible focus states, 4.5:1 contrast, the "Most popular" badge is real text, external links that open a new tab have `rel="noopener"`.
- Images (the product logos in section headings) have explicit width and height and meaningful alt text; the Tymelo mark is decorative (`alt=""`) because the word "Tymelo" is live text next to it.
- Prices are shown exactly as in config, formatted once. Do not compute or convert prices in Blade.
- Keep the layout from `layouts/app.blade.php`, SEO tags and GA gating as they are.

## 5. Meta

- Title: `Services and pricing | Build Syntax`.
- Description: `Prices for CarteNex digital menus, ShopNex online stores, Tymelo booking, LebaSouk POS, custom websites, hosting and maintenance.`
- Add `Product`/`Offer` structured data only if the repo already outputs JSON-LD elsewhere; if not, skip it.

## 5a. Read prices through a `Catalog` class (already created by the homepage step: extend it)

Use the `Catalog` class created in the homepage step and add (or `app/Services/Catalog.php`, follow the repo's existing convention). It is the ONLY thing views, Livewire components and tests use to read product, plan, hosting and maintenance data. Nothing outside this class calls `config('catalog')`. Methods, all returning plain arrays or collections:

- `products()`: the four products in display order, each with its plans and feature lines.
- `product(string $slug)`: one product, or `null`.
- `custom()`: custom development data and plans.
- `hosting()` and `maintenance()`: the tiers and plans (Services page only; add them when you build that page).
- `projectTypes()`: the contact form project types, read from `config('products.project_types')`.

Rules: same as the homepage step. The Services view, `Services.php` and `ServicesPageTest` read only from `Catalog`. Add `hosting()` and `maintenance()` and the Services data to `config/catalog.php` behind it.

## 6. Verification

1. `npm run build` and `php artisan test` pass.
2. Add `tests/Feature/ServicesPageTest.php`: `GET /services` returns 200; it contains every product name and every price in `config/catalog.php`; it does not contain "POS Pro", "99.9%" or "Early Access"; exactly one `<h1>`; every plan link points to `/contact` with a `type` that is in `config('products.project_types')`.
3. Playwright screenshots of `/services` at 1440px and 390px, compared with `services-reference.html`. Check: no sideways scroll at 390px, the sub-nav sticks below the header and highlights while scrolling, pricing cards in a section align their buttons along the bottom, and the browser console has no errors.
4. Open one plan link per product and confirm the contact form is prefilled correctly.
5. Small commits on `redesign/services`.

## 7. Final report

Short report: what changed, files touched, test results, screenshots taken, plus:
- **Other pages that still contradict the new prices.** Search `resources/views`, `app/` and `database/seeders` for old figures and names ("$699", "$49/mo", "$15/mo", "$1,400", "$800" next to POS, "POS Pro", "Early Access") and list each hit with file and line. Do not edit them.
- **Claims to confirm with the owner.** The custom development tiers, VPS hosting tiers and maintenance plans were carried over from the old page and were not checked against any product report. List them.
- Anything in the reference you could not reproduce, and why.
