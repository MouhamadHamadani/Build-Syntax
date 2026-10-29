# Prompt for Claude Code: apply the new design to About, Portfolio, Contact, Blog, legal and newsletter pages

Run this AFTER the homepage and Services prompts are done. Paste everything below the line into Claude Code, opened in the Build-Syntax repo root.

---

You are working in the Build Syntax Laravel repo (Laravel 12, Livewire 3, Tailwind 3.4, Alpine.js, Vite). The homepage and Services page are already redesigned: new tokens, header, footer, `config/catalog.php` and the `Catalog` class. Now bring the remaining public pages in line. Work on a new branch `redesign/pages` from the Services branch. Do not push, merge or deploy.

If the homepage tokens or the `Catalog` class are missing, stop and say so.

## 1. Design pack

In `homepage-design/`:
- `about-reference.html`, `portfolio-reference.html`, `contact-reference.html`: approved static designs. They are the source of truth for layout, spacing, type, colour and copy. Open each at 1440px and 390px first. Implement the dark values only. Their header shows only three links; the real header keeps its existing structure and the Products dropdown from the homepage step, so do not copy the reference header.
- `home-reference.html` and `services-reference.html` for shared components (cards, buttons, FAQ, contact block).

Pages with a reference: About, Portfolio, Contact. Pages without one (Blog index, Blog post, Privacy policy, Terms of service, Newsletter confirm, Newsletter unsubscribe, 404 if the repo has a custom one): restyle them with the same tokens and shared components, keep their content and behaviour, and make them look like the same site (section 5).

Do not touch: admin, auth and Jetstream views, migrations, models, routes, `.env`, the homepage and Services views.

## 2. About (`livewire/pages/about.blade.php`)

Rebuild to match `about-reference.html`: hero, story with four fact tiles, "How we work" four principles, three-step process (reuse the homepage's process partial; extract it into a Blade component if it is not one yet), closing contact block. Use the reference copy word for word. Removed on purpose: "Fast Turnaround", "Defect-free guarantee", the mission/vision/values boilerplate, "Our team", and the commented-out CTA. The page speaks as "we"; do not name or show a person.

## 3. Portfolio (`livewire/pages/portfolio.blade.php`, `app/Livewire/Pages/Portfolio.php`)

- Add the "Built by us" demo grid at the top: four cards from `Catalog::products()` (name, one line, headline price, demo link, screenshot from `public/images/showcase/*-laptop.webp`). Cards open the demo in a new tab with `rel="noopener"`.
- Keep the existing Livewire behaviour for client projects: category filter, search, pagination and the detail modal. Restyle them to the new tokens and chips. Do not change the query or the model.
- Category labels: `ecommerce` = ShopNex, `digital_menu` = CarteNex, `appointment` = Tymelo, `pos` = LebaSouk POS (replace "POS Pro"), `web` = Custom development, `other` = Other. Build the label map from one place (a method on `Catalog` or a config array), not a `@php` block in the view.
- Empty state exactly as in the reference ("Client case studies are on the way."). The paragraph under it in the reference that explains the admin is a note for you, not page copy: do not render it.
- Modal: focus moves into it on open, Escape closes it, focus returns to the button that opened it, `role="dialog"` and `aria-modal`, background does not scroll.
- Project card images: explicit width and height, `loading="lazy"`.

## 4. Contact (`livewire/pages/contact.blade.php`, `app/Livewire/Pages/Contact.php`)

- Match `contact-reference.html`. Keep ALL existing Livewire behaviour: `wire:model` fields, validation, honeypot or rate limiting if present, success message, the `?type=` and `?plan=` prefill. Do not change validation rules or the saved fields, except the project type options below.
- Project type options and labels, values unchanged and validated against `config('products.project_types')`: `website` Custom website, `ecommerce` ShopNex online store, `cartenex` CarteNex digital menu, `appointment` Tymelo booking, `pos` LebaSouk POS, `other` Other or not sure yet. Build the options from `Catalog::projectTypes()` plus a label map, so a new product appears automatically.
- Check `SITE_REVIEW_REPORT.md` for the old contact enum bug. If `Contact.php` and the database column or validation still disagree about allowed values, fix it and add a test.
- Error messages are linked with `aria-describedby`, invalid fields get `aria-invalid`, the submit button is disabled while sending, labels are real `<label for>`.
- WhatsApp button `https://wa.me/9613876822`. Phone and email are plain text and links (`tel:`, `mailto:`). Use `config('app.email')` if the page already does, otherwise `info@build-syntax.com`.
- FAQ copy as in the reference (timelines match the Services page, maintenance range $79 to $400). Take the numbers from `Catalog` where they exist instead of typing them.

## 5. Pages without a reference

- **Blog index and post** (the Blog link is hidden from the header; keep it hidden): restyle cards, headings, breadcrumbs, tags and the share buttons with the new tokens. Post body: wrap it in a `prose`-style component class with comfortable measure (about 70 characters), heading spacing, links, lists, code and blockquote styles. Keep `{!! nl2br(e($post->content)) !!}` exactly as it is (escaping is deliberate). Keep view counting, related posts and SEO tags. Remove the big newsletter block from the bottom of these pages only if the homepage step already moved newsletter to the footer; otherwise leave it and restyle it.
- **Privacy policy and Terms of service**: restyle as a narrow readable column (about 70 characters) with the new tokens, a table of contents is optional. Do not rewrite the legal text. Make ONLY these factual corrections, and list them in your report so the owner can review them:
  - Terms, "Services": replace "POS Pro" with "LebaSouk POS" and add "CarteNex, digital menus". Keep the other lines.
  - Terms, "Payment Terms": the 50% / 30% / 20% schedule is described as applying to everything. Reword the lead-in so it reads "Custom projects and ShopNex are paid 50% before development begins, 30% on delivery and 20% after training or handover. CarteNex is a monthly subscription. LebaSouk POS has no deposit and is paid once it is installed. Tymelo is a one-time setup fee followed by a monthly fee." Keep the hosting and maintenance sentence and the USD/LBP sentence.
  - Update the "Last updated" line on Terms to today's month and year only if you changed it.
  - Do not touch any other clause. Contact details stay as they are.
- **Newsletter confirm and unsubscribe**: restyle only, same behaviour.
- **404 and error pages**: if `resources/views/errors/` has custom pages, restyle them; if not, skip.

## 6. Quality rules (apply to every page)

- Use the homepage and Services components and classes. New shared patterns go in `@layer components`. No inline `<style>`, no new JS libraries.
- No `.fade-in` above the fold. One `h1` per page, headings in order, 4.5:1 contrast, visible focus states, real buttons and links.
- Keep SEO tags, canonical and OG tags, JSON-LD if present, GA gating and the sitemap.
- Do not add claims that are not in the references or the current page text. Removed claims in this prompt stay removed.

## 7. Verification

1. `npm run build` and `php artisan test` pass.
2. Add feature tests: About, Portfolio and Contact return 200 with one `<h1>`; Portfolio shows the four product names and does not contain "POS Pro"; Contact preselects the type from `?type=pos&plan=Standard` and shows the plan message; submitting a valid form with each project type succeeds; Terms does not contain "POS Pro".
3. Playwright screenshots of every page above at 1440px and 390px. Compare About, Portfolio and Contact with the references. Check: no sideways scroll, no console errors, the portfolio modal and filters work, the contact form works end to end in the browser.
4. Click every link in the header, footer and the new pages and confirm none is a 404.
5. Small commits on `redesign/pages`.

## 8. Final report

What changed, files touched, test results, screenshots. Plus:
- **Legal text changes** (exact before and after) for the owner to approve.
- **Leftover contradictions.** Search `resources/views`, `app/` and `database/` for "POS Pro", old prices ("$699", "$49/mo", "$15/mo", "$1,400") and "Early Access". List each hit; do not edit hits outside this prompt's scope.
- **Facts to confirm with the owner:** "Founded 2025", the 24-hour reply time, business hours Monday to Friday 9:00 to 17:00, and the line "You own the code and content made for your project once it is paid for" (it paraphrases the Terms).
- Anything you could not reproduce, and why.
