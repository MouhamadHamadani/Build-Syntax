# Catalog: services and pricing in the database

Products, plans, prices, features, hosting tiers and maintenance plans can live in the database and be edited at
**Admin → Services and pricing** (`/admin/services`). The public site reads them through `App\Support\Catalog`, which
returns the same arrays whichever source is used, so no public page changes.

`CATALOG_SOURCE` picks the source:

| Value | Reads from |
| --- | --- |
| `config` (default) | `config/catalog.php` and `config/products.php` |
| `database` | the `catalog_services`, `catalog_plans` and `catalog_plan_features` tables |

## Rollout

1. Deploy the code, then create the tables:

   ```bash
   php artisan migrate --force
   ```

2. Copy `config/catalog.php` into the tables (once):

   ```bash
   php artisan db:seed --class=CatalogSeeder --force
   ```

3. Switch the site to the database. In `.env`:

   ```
   CATALOG_SOURCE=database
   ```

   Then reload the configuration and clear the cache:

   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

   (If you cache configuration in production, run `php artisan config:cache` instead of `config:clear`.)

4. Open `/`, `/services`, `/portfolio` and `/contact` and check them. Edit prices at `/admin/services`.

## Roll back

Set `CATALOG_SOURCE=config` in `.env` and run `php artisan config:clear`. The tables and everything edited in them are
kept. Switch back to `database` at any time.

## How it behaves

- **Same shapes.** `Catalog::products()`, `product()`, `custom()`, `hosting()`, `maintenance()`, `projectTypes()`,
  `projectTypeLabels()` and `portfolioCategories()` return identical arrays from both sources. A test
  (`CatalogDatabaseTest`) compares them, and the text of the home, Services, Portfolio, Contact and About pages, after
  seeding.
- **Cache.** The assembled arrays are cached forever under `catalog.database`. Every save, reorder or delete of a
  service, plan or feature clears it (model events), so edits are live straight away. The editor itself always reads the
  tables, never the cache.
- **Fallback.** If `CATALOG_SOURCE=database` but the tables are empty or a query fails, the site answers from
  `config/catalog.php` and logs one warning every five minutes. A broken query never produces an empty site.
- **Prices are text.** A price is printed exactly as typed: `$349`, `From $800`, `Contact us`. A leading `From ` is
  printed before the amount, and a price with no digit (`Contact us`, `Custom quote`) is shown as plain text.
- **Hiding.** "Visible on the site" removes a product from every public page, the sub-navigation, the footer and the
  Products menu, and removes its contact type if it introduced one. Its data is kept. Custom development, hosting and
  maintenance are fixed sections of the Services page and cannot be hidden or deleted; their plans and copy can be edited.
- **New services** are created hidden, with their own contact form type (its label is the service name). Fill in the
  details and add plans, then switch on "Visible on the site". A new service has no hero screens or heading logo: those
  stay in code (`showcase` and `service.logo` in `config/catalog.php`, keyed by slug) and the pages skip them.
- **Contact types.** `config/products.php` keeps the six base types. `Catalog::projectTypes()` adds the type of every
  visible service, so a new service can introduce one; the contact form validates against that list.
- **Accents** are the `accent-*` classes in `resources/css/app.css` that `tailwind.config.js` safelists: saffron,
  emerald, tymelo, terracotta, brand and neutral. Tailwind cannot build other colours from the database.
- **Activity log.** Services and plans use `LogsActivity`: every price, name, billing or visibility change records who
  changed what and when. Feature list changes are logged as "features updated".

## Seeder warning

`CatalogSeeder` is safe to run again (it matches services by slug and plans by name), but it **resets every seeded
service and plan to the values in `config/catalog.php`**. Do not run it after editing prices in the admin. It does not
touch services added in the admin.

## Not moved to the database

The hero showcase screens and tab logos, the heading logos on the Services page, `config/products.php` (the contact
form type list and `portfolio_categories`) and the portfolio category labels.
