# Restaurant Menu App (PHP/MySQL)

![CI](https://github.com/dagron27/restaurant-menu-app/actions/workflows/ci.yml/badge.svg)

**Course:** `CSCI 300, Group Work for Computer Science`

**Assignment:** Restaurant menu app backend

This repository was originally hosted under a different name/account and has
since been moved to this personal GitHub account
(`github.com/dagron27/restaurant-menu-app`) with security remediation
applied (see Known Issues below).

## Assignment Intent

The assignment (labeled "group work," though the author was the sole
contributor) asked for an app with: (1) a home page with Breakfast/Dinner
buttons; (2) at least two favorite meals per option, each with a photo and
description, deployed on a LAMP stack with the server on the cloud; (3)
click-through navigation between the home page, a menu page, and an item
page showing the selected meal; (4) a GitHub workflow demonstrating team
pull requests, review, approval, and merging into a team lead's repository;
and (5) a short video demo of the app in use, submitted with the source
code to D2L.

**Confirmed implemented**, per the code (see Overview below): the
Breakfast/Dinner home-page buttons, four menu items with photos and
descriptions (two breakfast, two dinner) served from a MySQL `items_table`,
and the click-through navigation between home, menu, and item pages. The
stack (PHP + MySQL) matches LAMP's application-layer components, but
whether it was ever actually deployed to a cloud server (as opposed to run
locally) can't be confirmed from the repository alone -- that's a
deployment/infrastructure detail outside what a git checkout can speak to.

**Not applicable / not verifiable here:** item 4 (team PR review/approval
workflow) describes a multi-person GitHub process that doesn't apply the
way it's worded, since the author was this project's sole contributor
despite the "group work" label -- there's no evidence of, or expectation
of, cross-teammate PR review in a solo submission. Item 5's video demo is
not currently in this repository; if it's added later, this section should
be updated to reference it.

## Overview

A small demo restaurant menu site built with plain PHP, MySQL, and vanilla
JavaScript. There are no frameworks and no build step.

Navigation flow:

- `index.php` includes `home.php`, the site's home page.
- The home page links to a Breakfast page (`breakfast.php`) or a Dinner page
  (`dinner.php`).
- Each of those lists two menu items as buttons. Selecting an item loads one
  of `breakfast_page1.php`, `breakfast_page2.php`, `dinner_page1.php`, or
  `dinner_page2.php`.
- Each item page includes `db.php`, which connects to MySQL and runs
  `SELECT * FROM items_table`, then reads a specific array index out of the
  result (0-3, one per item page) to render that item's image and
  description.
- `assets/js/navigation.js` provides simple `navigateTo(page)` and `goBack()` helpers
  used by the Home/Back buttons; `assets/css/styles.css` provides all page styling.

There are no forms, no query-string parameters, and no other user-input
entry points anywhere in the app -- every page renders a fixed, hardcoded
array index against a fixed table. This rules out SQL injection, CSRF, and
IDOR as attack vectors for the app as it exists today; see Known Issues
below for what does apply.

## Repository Organization

The original submission had `schema.sql`, `navigation.js`, and
`styles.css` all sitting directly at the repository root alongside the
`.php` page files. `schema.sql` has been moved into `db/`, and
`navigation.js`/`styles.css` into `assets/js/` and `assets/css/`, for
portfolio-wide consistency with sibling repositories. The `.php` page
files themselves stay at the repository root: PHP's serving model ties
each page's URL to its file location, so moving them would break the
in-app navigation links and CI's smoke-test URLs for no organizational
benefit. `.github/workflows/ci.yml` and this README were updated to
match the `db/`/`assets/` paths.

## Dependencies

- PHP with the `mysqli` extension (no Composer, no `composer.json`, no
  package manager of any kind).
- MySQL/MariaDB server.
- No client-side dependencies; `assets/js/navigation.js` is hand-written vanilla JS
  with no libraries.
- No dependency manifest exists in this repo (no `composer.json`,
  `package.json`, or similar).

## Environment Setup

A `db/schema.sql` is now included with dummy/placeholder seed data (not real
menu content) so the app can be run from a clean checkout. To run it
locally:

1. Create/load the database and seed data: `mysql -u <user> -p < db/schema.sql`
   (this creates the `restaurant_db` database, the `items_table` table, and
   inserts the four rows the app expects, in the correct order -- see the
   comments in `db/schema.sql` for why order matters). Override the database
   name via the `DB_NAME` environment variable if you use a different one.
2. Set the `DB_HOST`, `DB_USER`, `DB_PASS`, and `DB_NAME` environment
   variables for your web server / PHP process. See `db.example.php` for a
   documented template and examples for common setups. `db.php` will
   refuse to connect (with a clear error) if `DB_USER` or `DB_PASS` are not
   set.
3. Point a PHP-capable web server at this directory and open `index.php`.
4. Images referenced by `image_path` should live under `images/` (see
   `Beef.png`, `Focaccia.png`, `FruttaFresca.png`, `PennePomodoro.png`);
   `db/schema.sql` already points each seed row at the correct file.

## Continuous Integration

A GitHub Actions workflow (`.github/workflows/ci.yml`) runs on every push
and can also be triggered manually via `workflow_dispatch`. It is a real
functional test, not just a syntax check:

1. Lints every `.php` file with `php -l`.
2. Starts a throwaway MySQL 8.0 service container (disposable `root`/`root`
   credentials, scoped to the CI run only) and loads `db/schema.sql` into it.
3. Starts PHP's built-in web server against the checked-out repo.
4. Requests `index.php`, both breakfast item pages, and both dinner item
   pages over real HTTP, and fails the job if any of them do not return a
   successful status -- this exercises the actual `db.php` connection path
   and the seed data end to end, not just that the files parse.

## Known Issues

### Security Findings

The findings below were identified in an earlier audit pass and have since
been remediated in this repo. They are kept here, marked as fixed, so the
history of what was wrong and what changed is still visible.

**CRITICAL (FIXED) -- Hardcoded plaintext database credentials committed to
the repo.** `db.php` previously contained a live-looking MySQL username and
plaintext password checked directly into source control as literal string
values.

This repository is public on GitHub, so anyone with the URL could have read
this credential directly had it remained in the published history.
**Fix applied:** `db.php` now reads its connection settings from
environment variables (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) via
`getenv()` instead of hardcoding them. `DB_USER` and `DB_PASS` have no
default and the script stops with a clear error if they are not set. See
`db.example.php` for a documented template of the required environment
variables and how to set them under common setups (shell, PowerShell,
Apache, php-fpm).
**History note:** this repository was published to GitHub with a single
fresh commit containing only the already-remediated code -- the original
history that contained the plaintext credential was never pushed here, so
there is nothing to scrub in this repo's own history. That said, if the
original credential was ever live anywhere (a real database, a shared
dev environment), it should still be treated as compromised and rotated,
independent of this repo's history.

**Medium (FIXED) -- Verbose error reporting and raw DB error leakage.**
`db.php` previously enabled `display_errors` and echoed the raw `mysqli`
connection error straight to any visitor if the connection failed (via
`die("Connection failed: " . $conn->connect_error)`).

If the database was ever briefly unreachable, this leaked internal details
(hostname, driver messages, potentially path/version info) to whoever
happened to load the page at that moment.
**Fix applied:** `display_errors` is now disabled (`ini_set('display_errors', 0)`).
On a connection failure, `db.php` now `die()`s with a generic
message ("A server error occurred. Please try again later.") instead of the
raw driver error. The real `$conn->connect_error` value is still available
in that code path for server-side logging if a logging framework is added
later; it is no longer sent to the client.

**Low (FIXED) -- Unescaped output enables stored XSS if the data source
ever becomes less trusted.** `breakfast_page1.php`, `breakfast_page2.php`,
`dinner_page1.php`, and `dinner_page2.php` each echoed `image_path` and
`description` directly into HTML with no `htmlspecialchars` escaping.

Not exploitable at the time, since there is no write path into
`items_table` anywhere in this app -- the only way to change these values
is direct database access. It would have become a stored XSS vector the
moment any less-trusted party (an admin UI, a CMS, a shared database)
gained the ability to edit a row.
**Fix applied:** Both `image_path` and `description` are now wrapped in
`htmlspecialchars()` before being echoed in all four item pages, as a
defense-in-depth measure ahead of any future write path.

**Informational -- Unbounded `SELECT *`.** `db.php` runs:

```php
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);
```

with no column list and no row limit. Not a problem with the current
two-column shape, but it's an over-fetch pattern that would silently start
exposing any sensitive column added to `items_table` in the future.
**Fix-it plan:** Select only the columns actually used (`image_path`,
`description`) rather than `*`.

### Dead Code and Hygiene

- `db.php` contains several commented-out debug statements left over from
  development (e.g. `//echo "Connected to the database successfully";` and
  `//var_dump($menu_items);`). Fix-it plan: remove once no longer needed
  for debugging.
- `index.php` line 3 has a stale comment referencing a `main_page.html`
  file that does not exist in this repo; the file actually included is
  `home.php`. Fix-it plan: update the comment to match.
- `assets/css/styles.css` line 1 has a header comment (`/* styles_main.css */`) that
  names a different filename than the actual file. Fix-it plan: correct the
  comment or remove it.
- `images/Focaccia1.png` is confirmed unused. Now that `db/schema.sql` fixes
  the seed data (and therefore exactly which four `image_path` values the
  app ever renders), it's confirmed that only `Beef.png`, `Focaccia.png`,
  `FruttaFresca.png`, and `PennePomodoro.png` are referenced -- fix-it plan:
  delete `images/Focaccia1.png` in a future cleanup pass (left in place
  here since removing image assets wasn't in scope for this pass).
- **(FIXED)** No SQL schema or seed file was included anywhere in the repo,
  so the application couldn't run from a clean checkout without manually
  recreating `items_table` and its rows. A `db/schema.sql` with dummy/
  placeholder seed data has been added (see Environment Setup above) --
  it creates `restaurant_db.items_table` and inserts the four rows each
  page expects, in the correct order.

## Status

This is a small school assignment/demo project, not production software.
The security findings above are fixed and this repository's own git
history contains only the already-remediated code (see the credential
finding above for why there is nothing to scrub here). If the original
plaintext credential was ever live in a real database, it should still be
rotated independent of this repo. The remaining items (Dead Code and
Hygiene) are lower-priority cleanup that can be addressed incrementally.
