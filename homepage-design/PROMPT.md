# Prompt for Claude Code: apply the new homepage design to build-syntax.com

Paste everything below the line into Claude Code, opened in the Build-Syntax repo root.

---

You are working in the Build Syntax Laravel repo (Laravel 12, Livewire 3, Tailwind CSS 3.4, Alpine.js, Vite). Your job is to apply a new homepage design to the real website. Work on a new branch called `redesign/homepage`. Do not push, merge or deploy.

## 1. The design to apply

The design pack is in `homepage-design/` (copy it into the repo root first if it is not there; do not commit that folder to `public/`):

- `homepage-design/home-reference.html` is the approved design as a single static page. It is the source of truth for layout, spacing, type scale, colours, copy and behaviour. Open it in a browser at 1440px and 390px wide before you write any code.
- `homepage-design/assets/showcase/*.webp` are real product screenshots (CarteNex, ShopNex, Tymelo, LebaSouk) for the hero.
- `homepage-design/assets/brand/*.svg` are the official logos (Build Syntax dark and light, CarteNex lockup, ShopNex logo, LebaSouk mark, Tymelo mark).

The reference supports light and dark themes. The real site is dark only, so implement the dark values only and ignore the light tokens and the `data-theme` blocks.

## 2. Scope

Do:
1. Design tokens in `tailwind.config.js` and `resources/css/app.css`.
2. Shared layout: `resources/views/layouts/app.blade.php`, `layouts/navigation.blade.php`, `layouts/footer.blade.php`.
3. The home page: `app/Livewire/Pages/Home.php` and `resources/views/livewire/pages/home.blade.php`.
4. A single product data file, `config/catalog.php`, used by the home page (see section 5). Do NOT use `config/products.php`: it already exists and holds the contact and portfolio taxonomy (`project_types`, `portfolio_categories`) that `Contact.php` validates against. Leave that file as it is.
5. Copy assets into `public/images/showcase/` and `public/images/brand/`.

Do not touch: admin (`app/Livewire/Admin`, `layouts/admin.blade.php`), auth and Jetstream views, migrations, models, routes (except none needed), `.env`, the sitemap, the Services, Portfolio, About, Contact, Blog and legal pages' content. They must keep working with the new tokens. If a change you make would visibly break one of them, fix only the break.

## 3. Tokens

Keep the existing brand and dark palette from `tailwind.config.js` (`brand-blue` #347dbe, light #4A90E2, `dark.primary` #0F0F23, `dark.secondary` #1A1A2E, `dark.tertiary` #16213E, muted #9CA3AF, text #F3F4F6). Add:

- Product accents: `saffron` #E5A526 (CarteNex), `emerald` #10B981 (ShopNex), `tymelo` #1D9E75 (Tymelo), `terracotta` #E2673F (LebaSouk POS).
- A mono font family `mono` for small uppercase labels: JetBrains Mono, 400 and 500.
- Plus Jakarta Sans 700, used only for the "Tymelo" wordmark chip.

Load fonts with the existing `<link>` in `layouts/app.blade.php`. Remove the duplicate `@import url(...)` of Google Fonts at the top of `resources/css/app.css` so fonts load once. Read exact sizes, weights and spacing from the reference's CSS, and express them with Tailwind utilities or small component classes in `@layer components`. No inline `<style>` blocks, no new JS libraries.

## 4. Behaviour and quality rules

- **Hero content must be visible at rest.** The current `.fade-in` utility starts at opacity 0 until `resources/js/app.js` runs, so the hero text is dim or invisible on load. Do not use `.fade-in` on anything above the fold. Keep it for sections further down.
- **Hero showcase** (the tabbed product screens): build it as an Alpine.js component, not inline vanilla JS. Four tabs with the product logos, one slide visible at a time, crossfade, auto-advance every 5 seconds until the visitor clicks a tab, and no auto-advance when `prefers-reduced-motion` is set. Use `role="tablist"`, `role="tab"`, `role="tabpanel"`, `aria-selected`, and arrow-key navigation between tabs. Images get explicit `width` and `height`, the first slide loads eagerly, the others use `loading="lazy"`, and every image has meaningful `alt` text as in the reference.
- **Header**: replace the icon and text logo with `build-syntax-logo-dark.svg` (dark site, so only the dark variant). Keep the existing sticky and scrolled behaviour, the Products dropdown and the mobile menu, but update the Products list to the four current products (CarteNex, ShopNex, Tymelo, LebaSouk POS) and remove "POS Pro" everywhere on the home page and in the navigation and footer.
- **Footer**: restyle to match the reference footer, keep all existing links and legal pages, and keep the contact details exactly as they are in the current footer unless they differ from the reference.
- **Newsletter**: the home design drops the large newsletter block. Do not delete the Livewire component, its routes, tables or admin screens. Reuse `App\Livewire\Components\NewsletterSubscribe` as a compact one-line form in the footer.
- **Contact buttons**: "Get a free quote" and similar buttons go to `route('contact')`. WhatsApp links use `https://wa.me/9613876822`. Show the phone number `+961 3 876 822` and `info@build-syntax.com` as plain text as well. `Contact.php` already reads `?type=` and `?plan=`, so link product buttons with `route('contact', ['type' => <project_type>, 'plan' => <plan name>])`.
- Accessibility: visible focus states, colour contrast of at least 4.5:1 for text, one `h1`, headings in order, buttons are `<button>`, links are `<a>`.
- Performance: no layout shift from images, no render-blocking additions, keep `@vite` and Livewire as they are.

## 5. Content and the product data file

Use the copy in `home-reference.html` word for word. Do not add, remove or reword claims. Every product claim in it was checked against that product's code and demo, and some features were removed on purpose because they are not built or not safe to promise.

Create `config/catalog.php` as the single source for the four products and custom development: name, slug, tag line, one-paragraph description, feature bullets, "for" line, plans (name, price text, description), headline price, note, demo URL, accent colour key, and the `project_type` value the contact form expects (`cartenex`, `ecommerce`, `appointment`, `pos`, `website`). Fill it from the reference. The home view must render the product cards through the `Catalog` class (section 5a), not from hard-coded markup, so the Services page can reuse it later.

Product demo links: CarteNex `https://cartenex.build-syntax.com/olea`, ShopNex `https://shopnex.build-syntax.com`, Tymelo `https://tymelo.build-syntax.com/book-guest`, LebaSouk POS `https://lebasouk.build-syntax.com/pricing`.

Open points. Keep them as they are in the reference and list them in your final report:
- LebaSouk Premium says "Contact us". The LebaSouk screens are English only for now.
- ShopNex Premium lists only multi-currency display, role permissions and priority support.
- The Tymelo logo is a mark only. The "Tymelo" text next to it is live text in Plus Jakarta Sans.
- Meta description: update `Home.php` so it names the four products. Keep the title format.

## 5a. Read prices through a `Catalog` class (do this, it prepares for a database later)

Create `app/Support/Catalog.php` (or `app/Services/Catalog.php`, follow the repo's existing convention). It is the ONLY thing views, Livewire components and tests use to read product, plan, hosting and maintenance data. Nothing outside this class calls `config('catalog')`. Methods, all returning plain arrays or collections:

- `products()`: the four products in display order, each with its plans and feature lines.
- `product(string $slug)`: one product, or `null`.
- `custom()`: custom development data and plans.
- `hosting()` and `maintenance()`: the tiers and plans (Services page only; add them when you build that page).
- `projectTypes()`: the contact form project types, read from `config('products.project_types')`.

Rules: no business logic and no formatting in the class (prices stay as display strings such as "From $800" or "Contact us"); register it as a singleton in a service provider; tests assert against `Catalog` output, not against hard-coded strings. Later the class will read from database tables instead of the config file, and no view will change, so keep its return shape stable and document it in a docblock.

## 6. Verification

1. Run `npm ci && npm run build` and fix any error.
2. Run `php artisan test`. Add one feature test, `tests/Feature/HomePageTest.php`, that checks: `GET /` returns 200; it contains the four product names and the headline prices from `config/catalog.php`; it does not contain "POS Pro"; it contains exactly one `<h1>`.
3. Take screenshots of `/` at 1440px and 390px with Playwright (the Chromium that is already installed) and compare them with `home-reference.html` at the same widths. List every visible difference and fix the ones that are not caused by Laravel or fonts. Check that the hero text is fully visible without scrolling or waiting, that tab switching works, and that nothing scrolls sideways at 390px.
4. Check the browser console for errors, and open `/services`, `/portfolio`, `/about`, `/contact`, `/blog` and `/admin/login` to confirm they still render with the new tokens, header and footer.
5. Commit in small, clear commits on `redesign/homepage`.

## 7. Final report

End with a short report: what changed, files touched, test results, screenshots taken, and these lists:
- **Contradictions on other pages.** Search `resources/views` for old prices and names ("$699", "$49/mo", "$15/mo", "$1,400", "POS Pro", "Laravel 12" on product claims, "3-step") and list each hit with file and line. Do not edit them. They will be fixed in the next step using `config/catalog.php`.
- **Open points** from section 5.
- Anything in the reference you could not reproduce, and why.
