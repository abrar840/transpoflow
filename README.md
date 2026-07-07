# TranspoFlow

A Laravel 11 multi-tenant SaaS for transport companies. A **Company** signs up, picks
services (ticket booking, cargo booking, fleet management) and a brand color, and gets a
public, branded site at `/{company}` where their customers book tickets and cargo.

**Stack:** Laravel 11 · Livewire 3 + Volt · Tailwind + Vite · Alpine.js · MySQL · spatie/laravel-permission

---

## Requirements

| Tool | Version |
|------|---------|
| PHP | ≥ 8.2 (8.4 tested) |
| Composer | 2.x |
| Node.js | ≥ 18 (20 tested) |
| MySQL | 8.x / 9.x |
| [Laravel Herd](https://herd.laravel.com/) | for local serving |

---

## Setup with Laravel Herd

Herd provides PHP, nginx and the `.test` domain. You still install dependencies and set up
the database yourself. **Herd's free tier does not bundle MySQL** — use a standalone MySQL
(or MySQL via Herd Pro).

### 1. Put the project in Herd's parked path

The Herd site is named after the **immediate folder**. If your app lives in a nested folder
(e.g. `Herd/transpoflow/transpoflow`), link the **inner** folder so the site points at the
real Laravel `public/`:

```bash
cd path/to/transpoflow          # the folder that contains artisan / public
herd link transpoflow           # → http://transpoflow.test
```

> If `http://transpoflow.test` shows a 404, Herd is parked on the wrong (outer) folder —
> `herd link` from the inner folder fixes it.

### 2. Install dependencies

```bash
composer install
npm install
```

> **Windows note:** if `composer install` fails on `livewire/volt` with *"Filename too
> long"*, enable long paths and reinstall with dist packages:
> ```bash
> git config --global core.longpaths true
> composer install --prefer-dist
> ```

### 3. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` for your database (defaults expect a MySQL DB named `fyp`):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fyp
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### 4. Database

Create the database, then migrate:

```sql
CREATE DATABASE fyp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

```bash
php artisan migrate --seed
```

### 5. Build front-end assets

⚠️ **The end-user site requires the Vite dev server running** — the branded customer pages
load images/CSS via `@vite` / `Vite::asset()`, which only resolve while `npm run dev` is up.

**For development (recommended):** keep this running in a terminal —

```bash
npm run dev
```

**For a one-off / production build:**

```bash
npm run build
```

> The dev server binds to `127.0.0.1:5173` (configured in `vite.config.js`). If assets fail
> to load in the browser, make sure `public/hot` points to `http://127.0.0.1:5173` (delete
> it and restart `npm run dev` if it shows an IPv6 `[::1]` address).

### 6. Open the app

- Marketing site: **http://transpoflow.test**
- A company's public site: **http://transpoflow.test/{company}** (e.g. `/skyline`)
- Company admin dashboard: **http://transpoflow.test/admin** (requires login)

---

## Local email (verification links)

`MAIL_MAILER=log` by default, so no real emails are sent — they're written to
`storage/logs/laravel.log`. To grab the latest email-verification link:

```bash
grep -oE "https?://[^\" ]*verify-email[^\" ]*" storage/logs/laravel.log | tail -1 | sed 's/&amp;/\&/g'
```

Paste that URL in your browser to verify a new account. (For a nicer inbox, switch
`MAIL_MAILER=smtp` and point it at Mailpit.)

---

## Common commands

```bash
# Everything at once (server + queue + logs + vite)
composer dev

# Individually
php artisan serve                 # (not needed under Herd)
npm run dev                       # Vite dev server (REQUIRED for end-user pages)
php artisan queue:listen          # queue worker (QUEUE_CONNECTION=database)

# Database
php artisan migrate
php artisan migrate:fresh --seed

# Tests (PHPUnit)
php artisan test
php artisan test --filter BusinessFormTest

# Code style (Laravel Pint)
vendor/bin/pint
vendor/bin/pint --test            # check only

# Logs (Laravel Pail)
php artisan pail
```

---

## Architecture (quick tour)

### Two auth guards, one users table
- **`web` guard** = company admins (managing their fleet/tickets/cargo).
- **`end_user` guard** = a company's customers (booking tickets).
- Both share the `users` table; every user has a `company_id`. The `check.company.admin`
  middleware enforces that an end user can only access their own company's `/{company}` site.
  **This is the multi-tenant isolation boundary** — almost every query is scoped
  `where('company_id', …)`; preserve that scoping in any new query.

### Signup / no-code flow
`Create Your Site` → login → **`/p`** (pick a brand color, live preview) → **`/form`**
(`BusinessForm`: company details + services + color) → your branded site goes live.

### End-user services (dynamic dispatch)
`/{company}/service/{service}` resolves a Livewire class by string convention:
`ticket-management` → `App\Livewire\Enduser\TicketBooking`. Class names must match the
transform or the route 404s.

### Theming — one theme, per-company color
There is a single end-user theme (`resources/css/enduser/theme1/`) driven by a CSS variable.
Each company stores a `brand_color` (on `company_themes`); `layouts.user` injects
`:root { --brand: … }`, and the theme CSS + `resources/css/enduser/brand-accents.css` use
`var(--brand)` so the whole site is tinted by the company's color.

### Key directories
```
app/Livewire/Admin/**      company-admin dashboard (fleet, tickets, cargo, export, messaging)
app/Livewire/Enduser/**    customer-facing pages served under /{company}
app/Trait/**               SharedTicketBooking / SharedBookingMethods (booking logic lives here)
resources/views/transpoflow/**   public marketing pages (Tailwind)
resources/views/livewire/**      Livewire component views
resources/css/enduser/**         end-user theme CSS
```

---

## Troubleshooting

| Symptom | Fix |
|---------|-----|
| `transpoflow.test` → 404 | `herd link` from the **inner** folder (that has `artisan`). |
| End-user pages unstyled / broken images | Start `npm run dev`; check `public/hot` = `127.0.0.1:5173`. |
| `composer install` "Filename too long" | `git config --global core.longpaths true` + `--prefer-dist`. |
| MySQL "access denied" | Set the real `DB_PASSWORD` in `.env`. |
| Nav needs two clicks / Livewire acts up | Ensure assets are rebuilt (`npm run dev`/`build`); Livewire is loaded once via `@livewireScripts` (do not also import it in `app.js`). |
