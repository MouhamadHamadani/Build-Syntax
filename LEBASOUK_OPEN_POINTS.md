# LebaSouk POS rollout: open points for discussion

*Report date: 2026-10-24, updated after the follow-up round. Branch: `feat/lebasouk-pos` (18 commits ahead of `main`, not pushed, no PR yet).*

**Who this is for.** Written so a Claude chat with no access to the repo can discuss the remaining points with the site owner. Everything needed is in here. Section 5 is the part to discuss. Section 6 is a one-screen decision sheet with a default for each point.

---

## 1. Context

**Site.** build-syntax.com, the Build Syntax company site. Laravel 12, Livewire 3, Tailwind, Alpine. Dark premium theme (`#0a0e17` base, `#347dbe` brand blue, Poppins). Public copy speaks as "we" (Build Syntax) and never names an individual founder.

**Task.** LebaSouk POS is now live as the fourth Build Syntax product, on its own subdomain:
- Product site: https://lebasouk.build-syntax.com/
- Pricing: https://lebasouk.build-syntax.com/pricing

The company site had to present it the way it presents ShopNex, CarteNex and Tymelo. An older "POS Pro / early access" section already existed and was replaced in place.

**Rules from the brief that still apply to any follow-up work.**
- Do not redesign layouts, change fonts, or restyle existing sections.
- Do not change existing prices or copy for ShopNex, CarteNex or Tymelo.
- Do not copy the full LebaSouk pricing table to the company site. The subdomain's pricing page is the source of truth. The company site shows a teaser and a link.
- Only contact details to use: WhatsApp/phone +961 3 876 822 (`wa.me/9613876822`) and info@build-syntax.com.
- No new dependencies, no framework or config changes, no migrations unless truly required.
- Never commit secrets or touch `.env`.

**Product facts (verified on the live pages on 2026-10-24).** The live pages matched the brief. These are the only facts safe to use in copy.
- Desktop point of sale for Lebanese businesses. Tagline: "The point of sale that runs your shop, with or without the internet."
- One-time license, installed and set up by us. No monthly fees, no per-device fees. Upgrading a tier means paying the difference, and data carries over. Every license includes on-site installation, loading the customer's products, and staff training.
- Target businesses: retail shops, pharmacies, restaurants and cafés, salons, wholesalers, repair shops.
- Features:
  - offline-first with automatic local backups
  - barcode scan-to-sell
  - USD and LBP on the same receipt with an editable exchange rate
  - Arabic RTL interface (Arabic and English)
  - roles and permissions
  - suppliers and purchase orders
  - margin and P&L reporting
- Tiers:

| Tier | Price | Limits | Adds |
|---|---|---|---|
| Starter | $600 | 1 device, 1 user | |
| Standard | $850 | up to 3 devices and users | returns with manager approval, suppliers and POs, customer profiles and loyalty, more roles, margin/P&L reports (live page also lists "priority email and WhatsApp support") |
| Premium | custom quote | unlimited devices and users | customizable receipts, priority phone support, on-site installation and training visit (live page also lists "faster bug-fix SLA") |

- Product-site CTAs: "Order Now" (`/order`) and "Request a Demo" (`/demo`).

**Other products as shown on the company site (do not change):** ShopNex from $1,200; CarteNex from $15/mo (self-serve subscription); Tymelo from $699 + $49/mo; custom web development from $1,500.

---

## 2. What has shipped on the branch

| Area | Change |
|---|---|
| Brand token | `lebasouk: '#e2673f'` in `tailwind.config.js:28`. This is the product site's own `--color-accent`. Used on the home card price line and on the services pill and price line. |
| Homepage | The 4th service card is now "LebaSouk POS — Point of Sale": tagline, 4 bullets, "From $600 one-time", and links to the product site and `/pricing`. The hero code panel entry is renamed. |
| Services page | The old POS Pro three-tier table (at $800 / $1,400 / custom) is replaced by a teaser in the same pattern as the other products: pill, heading, 3 feature cards, "From $600 · one-time license · installation included", a "View LebaSouk Pricing →" button, a product-site link, a WhatsApp link with a LebaSouk prefill, and a contact-form link. The sticky tab is now "LebaSouk POS". The `#pos` anchor is kept. |
| Nav | The Products dropdown (desktop and mobile) links to the lebasouk subdomain, with the same plain-link convention as the other products (no `target`, no `rel`). |
| Footer | New "Products" group under Quick Links with all four products. |
| Contact | The existing `pos` option is relabelled "LebaSouk POS (Point of Sale)". The stored value stays `pos`, so no migration. The admin email label is updated too. `/contact?type=pos` preselects it. |
| Portfolio | The category label for `pos` is "LebaSouk POS" on the public filter and the admin create/edit forms. |
| Meta | The portfolio meta description names the products. The services description was trimmed in the follow-up round (section 2b). |
| Terms | Reworked in the follow-up round (section 2b). |
| Config | `CONTACT_EMAIL` fallback in `config/app.php` and `CONTACT_ADMIN_EMAIL` fallback in `config/mail.php` now `info@build-syntax.com`. The newsletter confirmation email footer says build-syntax.com. |
| Tests | New `ContactLebaSoukTest` (2 tests). Fixed two broken tests: login redirect pointed at a non-existent `dashboard` route, and the homepage test lacked a database. |

**Verification done.**
- Full suite passes (26 passed, 8 skipped for disabled Jetstream features). `npm run build` passes.
- No horizontal overflow on `/`, `/services`, `/portfolio`, `/contact` and the footer at 375, 768 and 1280px.
- Contact form submitted in a real browser with the LebaSouk option, against a throwaway SQLite DB with the mail driver set to log. It showed the success message, stored `project_type = pos`, and produced the admin email addressed to info@build-syntax.com labelled "LebaSouk POS (Point of Sale)".
- Every new link was clicked in the browser and landed on the right lebasouk page. The WhatsApp link was checked by `href` only.
- Greps for "POS Pro", "on hold", "three products", `71 293 685` and `buildsyntax.dev@gmail.com` are clean in app code. Only the `instagram.com/buildsyntax.dev` handle remains, which is a real social handle.

## 2b. Follow-up round (owner-approved)

| Item | Result |
|---|---|
| Terms of service (option A, owner-supplied facts) | §2 adds CarteNex and relabels LebaSouk POS. §3 scopes the 50/30/20 schedule and adds one paragraph each for LebaSouk POS and CarteNex. "Last updated" is now October 2026. Percentages and all other clauses are unchanged. **The wording is pending owner review.** Exact before/after is below. |
| Services payment note | No longer claims "all packages". Scoped to custom development, with a line for LebaSouk POS. |
| Services meta description | 138 characters (limit 155): "Transparent pricing for custom web development, ShopNex e-commerce, CarteNex digital menus, Tymelo booking and LebaSouk POS point of sale." |
| Hero panel order | ShopNex, CarteNex, Tymelo, LebaSouk POS. Order only. |
| Arabic link | "العربية" → `https://lebasouk.build-syntax.com/?lang=ar` in the LebaSouk teaser. `lang="ar"`, no `target` or `rel`. No other Arabic strings and no RTL changes. |
| Organization JSON-LD | One block in `layouts/app.blade.php`, built with `json_encode`. Company facts only (name, url, logo, phone, email, Beirut/LB address, Facebook and Instagram `sameAs`). No prices, products or people. The Facebook URL is the footer's, minus its empty trailing `#`. |
| Leftover worktree | Removed safely (section 5.7). |
| Accent colour | Unchanged (`#e2673f`). |
| Tests | New `LebaSoukPagesTest` (6 tests). Full suite: 32 passed, 8 skipped. `npm run build` passes. |
| Responsive and page checks | `/`, `/services`, `/terms-of-service`, `/contact?type=pos` at 375, 768 and 1280px: no horizontal overflow. Exactly one JSON-LD block per page, valid JSON. The leftover grep for "POS Pro", the old phone number and the old gmail is clean; only the `instagram.com/buildsyntax.dev` handle remains. |

### Exact terms wording, before and after (for owner review)

**Header.** Before: `Last updated: May 2026`. After: `Last updated: October 2026`.

**§2 Services list.**

Before:
- Custom web development (websites and web applications)
- ShopNex — e-commerce platforms
- Tymelo — appointment booking systems
- LebaSouk POS — point-of-sale systems
- Hosting & maintenance plans

After:
- Custom web development (websites and web applications)
- ShopNex — e-commerce platforms
- **CarteNex — digital menu platform (monthly subscription)** *(new)*
- Tymelo — appointment booking systems
- **LebaSouk POS — point-of-sale software (one-time license)** *(reworded)*
- Hosting & maintenance plans

**§3 Payment Terms.**

Before:
- 50% deposit due before development begins.
- 30% on project delivery.
- 20% after training / handover.
- Hosting plans are billed annually; maintenance plans are billed monthly with a 3-month minimum.
- All prices are quoted and payable in USD. LBP equivalents accepted at the current market rate on the day of payment.

After (same five bullets, unchanged, plus three new paragraphs):

- **New opening paragraph:** "The 50% / 30% / 20% schedule below applies to custom development and project-based platform work. It does not apply to LebaSouk POS or CarteNex."
- *(the five bullets above, unchanged)*
- **New paragraph after the bullets:** "**LebaSouk POS** is sold as a one-time license with no upfront deposit. Payment is due once installation is complete. Any custom system or feature requested beyond the standard installation is quoted and billed separately under the schedule above."
- **New paragraph:** "**CarteNex** is billed as a monthly subscription; its price and billing terms are shown on its own site at the time of sign-up."

**Services page payment note (`services.blade.php`, same element and styling).**
- Before: `50% deposit · 30% on delivery · 20% after training — available on request for all packages.`
- After: `50% deposit · 30% on delivery · 20% after training — available on request for custom development projects. LebaSouk POS: no deposit, payment on completion of installation.`

---

## 3. Closed since the earlier report

- **Live `.env` fixed.** The owner confirms the live `.env` is fixed (it had held the old gmail address). The local `.env` still holds the old address, but it is for testing only, so this is not an issue and nothing should be changed there.
- **Stale local autoloader.** Fixed, with a recurrence risk (section 5.7).
- Footer Products group, test fixes and old-domain fallbacks are done.
- Follow-up round (section 2b): terms and services note, meta description, hero order, Arabic link, Organization JSON-LD and worktree removal.

---

## 4. Not changing, by design (settled, mention only if asked)

- **Stored value stays `pos`.** Old leads stay valid. Any historical "POS Pro" enquiries will now show as "LebaSouk POS" in the admin email and admin lists.
- **No explicit "unlike our other products" claim.** The copy stresses "a one-time license, not a SaaS subscription". ShopNex's billing terms are not verifiable here, and Tymelo has a monthly retainer, so a direct comparison could be wrong.
- **Nav label.** It is "LebaSouk POS" rather than the "Name — Category" pattern, because the longer text wraps in the `w-56` dropdown.
- **Existing copy untouched.** Home hero text ("custom websites, e-commerce platforms, and appointment systems") and the home meta description do not list products, so they were left alone per the scope guard.

---

## 5. Open points to discuss

| # | Point | Status |
|---|---|---|
| 5.1 | Terms and payment wording | **Implemented (option A); pending owner review of the wording** |
| 5.2 | Structured data | **Organization block done.** Product markup on the product sites is still open (outside this repo). |
| 5.3 | Sitemaps | Open: the LebaSouk site has no sitemap (outside this repo) |
| 5.4 | Portfolio entry | **Deferred by owner** |
| 5.5 | Arabic | **Link added.** Full localisation not pursued. |
| 5.6 | Accent colour | **No change (owner decision)** |
| 5.7 | Leftover worktree | **Done** |
| 5.8 | Smaller choices | Meta length and hero order **done**; the rest as shipped |
| 5.9 | Live checks | Open: after deploy |

### 5.1 Terms of Service and the payment-schedule wording

**Status: implemented on the branch (option A) using the owner's facts. The owner still needs to confirm the wording before anything is merged. The shipped wording is in section 2b. The analysis below is the original discussion.**

**Current text (`terms-of-service.blade.php`, "Last updated: May 2026").**
- §2 Services lists: custom web development; ShopNex; Tymelo; LebaSouk POS (point-of-sale systems); hosting and maintenance. **CarteNex is missing.**
- §3 Payment Terms: "50% deposit due before development begins. 30% on project delivery. 20% after training / handover." Then hosting is billed annually, maintenance monthly with a 3-month minimum, and prices are in USD (LBP at market rate).
- The services page note (`services.blade.php:52`) says: "50% deposit · 30% on delivery · 20% after training — available on request for all packages."

**Problem.**
- LebaSouk POS is a one-time license (live page: "You buy the license once"). Nothing on the product pages mentions a deposit or instalment schedule.
- CarteNex is a self-serve monthly subscription.
- The 50/30/20 schedule reads as applying to everything, including these two. Adding CarteNex to §2 without scoping §3 could imply the schedule applies to it.

**Why not done.** This is legal and commercial wording only the owner can confirm. It needs facts we don't have: which products actually use 50/30/20, and what the order terms on lebasouk and cartenex say.

**Options.**
- **A (recommended).** Add CarteNex to §2. Add one sentence at the top of §3 scoping the schedule. Update the services note to name the products it applies to. Show the wording to the owner before committing.
- **B.** Change only the services note. Leave the terms alone.
- **C.** Leave everything. Low effort, but the page keeps contradicting a one-time-license product.

**Draft wording for option A.** A starting point to adapt, not legal advice. The owner or a lawyer should confirm the facts. Two of these lines depend on assumptions marked **[confirm]**.
- §2, new line: `CarteNex — digital menu platform (monthly subscription)`
- §2, LebaSouk line: `LebaSouk POS — point-of-sale software (one-time license)`
- §3, new opening sentence: "The schedule below applies to custom development and installed-platform projects **[confirm which products]**. LebaSouk POS is sold as a one-time license and CarteNex as a monthly subscription; their prices and payment terms are set out on their own sites at the time of order."
- Services note: "50% deposit · 30% on delivery · 20% after training — available on request for custom development, ShopNex and Tymelo projects **[confirm]**."
- If the ToS changes, also update "Last updated".

**Questions for the owner.**
1. Which products use the 50/30/20 schedule?
2. Does LebaSouk offer any deposit or instalment option?
3. Is a lawyer reviewing the terms, or should we only align the wording?

### 5.2 Structured data (JSON-LD)

**Status: option b (Organization block) is done. Option d (per-product markup on each product subdomain) is still open and outside this repo. Option c was not pursued.**

**State.** There is none on the company site (no `ld+json` anywhere in `app/` or `resources/`). The LebaSouk product site has none either (checked on the live homepage).

**Why not done.** The brief said to add it only "if JSON-LD lists products or services". It doesn't, so adding it would be a new feature. Encoding prices for the other three products would also create maintenance risk, and Google requires markup to match visible page content.

**Options.**
- **a.** Nothing (current).
- **b.** Add a small `Organization` block in `layouts/app.blade.php`: name, url, logo, phone, email, address "Beirut, Lebanon" and the Facebook/Instagram links already in the footer. No prices, low risk.
- **c.** Also add an offer catalog for all four products. Adds SEO surface but needs price upkeep in two places.
- **d.** Put per-product `SoftwareApplication` markup with real offers ($600 and $850 Starter/Standard, Premium on request) on each product's own subdomain, where the pricing lives.

**Recommendation.** b on the company site plus d on the product sites. Skip c.

**Questions.** Is publishing the Organization data fine (city only, no street address)? Can the product site be edited, and is it a separate repo?

### 5.3 Sitemaps

**Findings.**
- The company sitemap (`SitemapController`) lists only company URLs: home, services, portfolio, about, contact, privacy, terms.
- Under the sitemaps.org protocol a sitemap lists URLs on its own host. So product subdomains should not be added to the company sitemap.
- ShopNex, CarteNex and Tymelo each serve their own `/sitemap.xml` (HTTP 200).
- **LebaSouk's `/sitemap.xml` returns 404.** Its `robots.txt` is `User-agent: *` and an empty `Disallow:`, with no `Sitemap:` line.

**Recommendation.**
- No change on the company site.
- Add a `sitemap.xml` plus a `Sitemap:` line in `robots.txt` on the LebaSouk product site, for parity with the other three. That is outside this repo.

**Question.** Is the LebaSouk site's code available to this workflow, or handled separately?

### 5.4 Portfolio entry for LebaSouk POS

**Status: deferred by owner.**

**State.** Portfolio items are database rows created at `/admin/portfolio/create`. Nothing is seeded in code, so there was nothing to mirror. The admin form fields are:
- `title`
- `description`
- `category`
- `technologies` (comma-separated)
- `project_url` (must be a URL)
- `image_url` (must be a URL; there is no file upload)
- `featured`

A local row would not reach production, so this has to be entered in the live admin.

**Draft entry using only verified facts. No testimonials, client names or metrics.**
- Title: `LebaSouk POS`
- Category: `pos`
- Description: "Desktop point-of-sale system for Lebanese businesses. Works offline with automatic local backups, barcode scan-to-sell, USD and LBP on the same receipt with an editable exchange rate, and an Arabic/English right-to-left interface. Sold as a one-time license, installed and set up by us."
- Project URL: `https://lebasouk.build-syntax.com`
- Technologies: **unknown. The owner must supply the real stack.** Do not guess.
- Image: needs a real screenshot of the live site. It must be hosted at a public URL, for example uploaded under `public/images/` and referenced by absolute URL.
- Featured: the owner's call.

**Questions.** Is the company's own product appropriate in a portfolio of client work? What is the true technology stack? Is a screenshot wanted, and where should it be hosted?

### 5.5 Arabic and RTL

**Status: option d done (an "العربية" link in the teaser to the Arabic product site). Full localisation (option c) was not pursued.**

**State.** The company site has no Arabic strings, no `lang/` directory, no `dir="rtl"`, and `<html lang="en">` with `og:locale en_US`. The site markets "Bilingual EN / AR" as a capability for client work. The LebaSouk product site has a working Arabic toggle (`/?lang=ar`).

**Why not done.** The brief asked for Arabic copy only "if the site has Arabic strings or RTL handling". It has neither. A single Arabic block on an otherwise English page would be inconsistent and would need per-block RTL handling.

**Options.**
- **a.** Stay English-only (current).
- **b.** Arabic only for the LebaSouk teaser strings. Awkward and inconsistent.
- **c.** Proper company-site localisation: language switcher, lang files, RTL layout, `hreflang`, Arabic meta. A project in its own right that touches every page.
- **d.** Cheap middle path: add an "العربية" link in the LebaSouk teaser pointing to `https://lebasouk.build-syntax.com/?lang=ar`.

**Recommendation.** d now. Treat c as a separate decision if Arabic-first customers are a target. Any Arabic copy should be natural Lebanese business Arabic and **proof-read by a native speaker** before shipping. The English strings that would need translating are in the appendix.

**Question.** Is a full Arabic version of the company site wanted, now or later?

### 5.6 Accent colour distinctness

**Status: no change. The owner chose to keep `#e2673f`.**

**Numbers.**

| Product | Token | Hue | Saturation | Lightness |
|---|---|---|---|---|
| ShopNex | orange-400 `#fb923c` | 27° | 96% | 61% |
| CarteNex | rose-400 `#fb7185` | 351° | 95% | 71% |
| Tymelo | teal-400 `#2dd4bf` | 172° | 66% | 50% |
| LebaSouk | `#e2673f` | 15° | 74% | 57% |

LebaSouk sits between ShopNex and CarteNex on the colour wheel, deeper and less saturated than both. On screen it reads as a red-orange and is distinguishable, but its nearest neighbours are both of the other products.

**Accessibility.** Contrast of `#e2673f` is 5.74:1 on `#0a0e17`, 5.61:1 on `#0F0F23`, 5.07:1 on `#1A1A2E` and 4.73:1 on `#16213E`. That passes WCAG AA for normal text on every site background.

**Options.**
- **a (recommended).** Keep it. It matches the product site's own brand colour, which was the brief's first preference.
- **b.** Pick a clearly different hue such as violet. This loses brand match with the product site.
- **c.** Use a neutral tone from the product's palette (peach or sand). This is distinct but low-energy.
- **d.** Use the product palette's lighter accent `#ef9271`. Better contrast but closer to ShopNex orange.

**Cost to change.** One line in `tailwind.config.js`. The token is used in three places.

**Question.** Does the services page look too close to ShopNex and CarteNex side by side?

### 5.7 Leftover git worktree can break the local autoloader again

**Status: done.** Result of the safe removal:
- **Pre-checks passed.** The worktree's `git status` was clean (no changes, no untracked files). `git log main..claude/nice-cannon-588d12` was empty, because the branch tip was already an ancestor of `main`. Its gitignored `.env` was an older copy of the main one with no unique keys (only `CONTACT_PHONE` held a different, older value), so nothing was lost.
- **Junctions removed first.** `cmd /c rmdir` (no `/s`) on the worktree's `vendor` and `node_modules`. The main checkout's `vendor` (51 entries) and `node_modules` (137 entries) were intact afterwards.
- **Worktree removed.** `git worktree remove`, then `git worktree prune`. `git worktree list` now shows only the main checkout.
- **Branch deleted.** `git branch -d claude/nice-cannon-588d12` (safe delete, no unique commits).
- **Autoloader rebuilt from main.** `composer dump-autoload` in the main checkout. `autoload_psr4.php` now has `$baseDir = dirname($vendorDir)`, and `App\` classes load from the main `app/` folder.
- **One cosmetic leftover.** `vendor/composer/installed.php` still has two `install_path` entries (root package metadata) pointing at the deleted worktree path. It does not affect autoloading. A `composer install` in the main checkout would rewrite it, but that was not requested, so it was left alone.
- **Rule going forward.** Never run `composer` or `npm` from inside a worktree.

The original analysis follows.

**What happened.**
- `.claude/worktrees/nice-cannon-588d12` is a leftover worktree (detached HEAD `f64427d`, branch `claude/nice-cannon-588d12`).
- Its `vendor` and `node_modules` are Windows junctions to the main checkout's folders.
- Composer had been run from inside it, which rewrote the shared `vendor/composer/autoload_*.php` so `$baseDir` pointed at the worktree. The main site silently loaded every `App\` class from the old worktree. That showed up as stale email labels and meta descriptions locally.
- Fixed by running `composer dump-autoload` in the main checkout. Production should be unaffected (a fresh `composer install` builds its own autoloader), so this looks local-only, but it has not been checked on the server.

**Risk.** It recurs if Composer runs from that worktree again.

**Options.**
- **a (recommended).** Remove the worktree. **Caution:** delete the two junctions first so only the links are removed (`cmd /c rmdir <path>\vendor` and the same for `node_modules`). Deleting the folder recursively could follow the junctions and wipe the shared `vendor` and `node_modules`. Then run `git worktree remove .claude/worktrees/nice-cannon-588d12`, and optionally delete the branch `claude/nice-cannon-588d12`.
- **b.** Leave it. If the symptom returns, run `composer dump-autoload` from the main checkout.

**Question.** Is that worktree still needed for anything?

### 5.8 Smaller product choices to confirm

**Status: items 4 (meta description length) and 5 (hero panel order) are done. The rest stay as shipped.**

1. **CTAs.** The product site's "Order Now" (`/order`) and "Request a Demo" (`/demo`) are not on the company teaser, which links to pricing, the product site, WhatsApp and the contact form. Add them as buttons?
2. **Product-site inconsistency (not in this repo).** On the live pricing page the Standard tier's "Order Now" goes to `/order?plan=professional`, a slug that doesn't match the tier name "Standard". Worth fixing there.
3. **Homepage card height.** The bullets make the LebaSouk card taller, so the neighbouring Tymelo card stretches to match at desktop width. Keep the bullets (the brief asked for them) or move them to the services page only?
4. **Meta description length.** The services description is now 196 characters, so search results will probably truncate it at around 155–160. Trim it? **Done: 138 characters.**
5. **Hero panel product order.** The hero code panel lists ShopNex, Tymelo, CarteNex, LebaSouk POS, but the site order is ShopNex, CarteNex, Tymelo, LebaSouk POS. This was already so; only the name was changed. Align the order? **Done.**
6. **WhatsApp prefill.** The LebaSouk-specific text exists only on the services teaser. The floating button and footer keep the generic "discuss a project" text.
7. **Contact budget field.** Options are Under $1,000, $1,000–2,500, $2,500–5,000 and $5,000+. LebaSouk leads fit "Under $1,000", but the scale suits custom work better than $600–850 products.
8. **Social image.** All pages share one OG image (`images/icon.png`). There is no LebaSouk-specific share image.

### 5.9 Things not verified, to check on live

- **Admin email delivery.** `NewContactSubmission` implements `ShouldQueue` and the default queue is `database`, so notification emails are sent only if a queue worker is running on the live server. The end-to-end test used a synchronous queue and a log mailer, not the production SMTP and worker. Confirm a worker or scheduler runs on live, and send one real test enquiry after deploy.
- **Real devices.** Responsive checks used emulated 375, 768 and 1280px viewports, not physical phones. No screen-reader or keyboard-only pass.
- **WhatsApp prefill.** The link was checked by `href` only. It was not opened.
- **Deploy hygiene.** After merge, on the server: `npm run build`, `php artisan view:clear`, and check that `/services`, `/contact?type=pos` and the footer links work.
- **Wider review.** The older `SITE_REVIEW_REPORT.md` (still mentions POS Pro) was not re-audited. Only POS-related items were touched.

---

## 6. Decision sheet, with a default if the owner has no preference

| # | Point | Status | Default if no answer | Needs the owner? |
|---|---|---|---|---|
| 5.1 | ToS and payment wording | Implemented, pending wording review | n/a | Yes: review the before/after in section 2b |
| 5.2 | JSON-LD | Organization block done | Product markup on product sites later | Only for the product-site part |
| 5.3 | Sitemap | Open (outside this repo) | Add a sitemap to the LebaSouk site | Whether the product site is reachable |
| 5.4 | Portfolio entry | Deferred by owner | Hold | Later: stack, screenshot, fit |
| 5.5 | Arabic | Link added | Nothing further | Only if a full Arabic site is wanted |
| 5.6 | Accent colour | No change | Keep `#e2673f` | No |
| 5.7 | Worktree | Done | n/a | No |
| 5.8 | Small choices | Meta length and hero order done | Keep the rest as shipped | Optional |
| 5.9 | Live checks | Open, after deploy | Run after deploy | Yes: confirm the queue worker |

---

## Appendix A. New public English strings (for translation, if 5.5 option b or c is chosen)

**Home card:** "LebaSouk POS — Point of Sale"; "The point of sale that runs your shop, with or without the internet."; "Offline-first, with automatic local backups"; "Barcode scan-to-sell"; "USD and LBP on the same receipt"; "Arabic & English, full right-to-left"; "From $600 one-time"; "Learn More →"; "See Pricing →".

**Services teaser:** tab "LebaSouk POS"; pill "Desktop POS · One-Time License"; heading "LebaSouk POS — Point of Sale for Lebanese Businesses"; intro "The point of sale that runs your shop, with or without the internet. For retail shops, pharmacies, restaurants & cafés, salons, wholesalers and repair shops — installed and set up by us."

Cards:
- "Pay once, not monthly" / "A one-time license, not a SaaS subscription. No monthly fees and no per-device fees; upgrading a tier means paying the difference, and your data carries over."
- "Works offline" / "Keeps selling through internet outages, with automatic local backups and barcode scan-to-sell."
- "Built for Lebanon" / "USD and LBP on the same receipt with an editable exchange rate, in Arabic (RTL) and English."

Price line: "From $600 · one-time license · installation included". Button: "View LebaSouk Pricing →". Links: "Visit lebasouk.build-syntax.com"; "Ask on WhatsApp"; "Contact us". WhatsApp prefill: "Hi Build Syntax, I'd like to know more about LebaSouk POS."

**Other:** contact option "LebaSouk POS (Point of Sale)"; nav and footer "LebaSouk POS"; portfolio filter "LebaSouk POS".

## Appendix B. Where things live

| What | File |
|---|---|
| Accent token | `tailwind.config.js:28` |
| Home card, hero panel | `resources/views/livewire/pages/home.blade.php` (card near line 232) |
| Services teaser | `resources/views/livewire/pages/services.blade.php` (`#pos` section near line 190; payment note line 52) |
| Nav and footer | `resources/views/layouts/navigation.blade.php`, `footer.blade.php` |
| Contact options | `resources/views/livewire/pages/contact.blade.php` |
| Allowed contact and portfolio values | `config/products.php` (`project_types`, `portfolio_categories`) |
| Admin email label map | `app/Notifications/NewContactSubmission.php` |
| Terms | `resources/views/livewire/pages/terms-of-service.blade.php` (§2 near line 29, §3 near line 41) |
| Sitemap | `app/Http/Controllers/SitemapController.php` |
| Meta descriptions | `app/Livewire/Pages/Services.php`, `Portfolio.php`, `Home.php` |
| Organization JSON-LD | `resources/views/layouts/app.blade.php` (in `<head>`, after the favicon) |
| New tests | `tests/Feature/ContactLebaSoukTest.php`, `tests/Feature/LebaSoukPagesTest.php` |
