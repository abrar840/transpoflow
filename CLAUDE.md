# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

TranspoFlow is a Laravel 11 multi-tenant SaaS for transport companies. Each **Company** signs up, picks services (ticket booking, cargo booking, fleet management) and a visual theme, and gets a public-facing branded site at `/{company:name}` where their customers ("end users") book tickets and cargo. The stack is **Livewire 3 + Volt** for the UI (server-rendered components, minimal JS), **Tailwind** via Vite, MySQL, and **spatie/laravel-permission** for roles.

## Commands

Uses PHP/Composer + Node. There is no test/lint npm script — use artisan and vendor binaries directly.

```bash
# Full dev environment (server + queue + logs + vite, all at once)
composer dev

# Or individually:
php artisan serve
npm run dev                    # vite dev server
php artisan queue:listen       # queue worker (QUEUE_CONNECTION=database)

# Assets
npm run build                  # production vite build

# Database
php artisan migrate
php artisan migrate:fresh --seed

# Tests (PHPUnit, config in phpunit.xml)
php artisan test
php artisan test --filter BusinessFormTest       # single test class
vendor/bin/phpunit tests/Unit/BusinessFormTest.php

# Code style (Laravel Pint, no config file = Laravel preset)
vendor/bin/pint
vendor/bin/pint --test          # check only, no changes

# Logs (Laravel Pail)
php artisan pail
```

Tests run with `APP_ENV=testing` (see `phpunit.xml`): array cache/session/mail, sync queue. The `DB_CONNECTION=sqlite`/`:memory:` lines are **commented out**, so tests hit the configured MySQL DB unless you uncomment them.

## Architecture

### Two auth guards, one users table
This is the central design choice — read `config/auth.php` and `app/Http/Middleware/CheckCompanyAdmin.php` before touching auth.

- `web` guard = **company admins** (the business owner managing their fleet/tickets). Routes gated by `middleware('auth')`.
- `end_user` guard = **customers of a company** (people booking tickets). Both guards use the same `users` table/provider; the distinction is which guard logged them in.
- Every user has a `company_id`. The `check.company.admin` middleware (aliased in `bootstrap/app.php`) enforces that a logged-in `end_user` may only access the `/{company}` site matching their own `company_id`, and logs them out otherwise. This is the multi-tenant isolation boundary.

### Dynamic service dispatch (routes/web.php)
The public site route `/{company:name}/service/{service}` resolves a Livewire class **by string convention**: it title-cases the `{service}` slug, replaces `Management`→`Booking`, and instantiates `App\Livewire\Enduser\{ServiceName}` via `__invoke`. So `ticket-management` → `App\Livewire\Enduser\TicketBooking`. When adding an end-user service, the class name must match this transform or the route 404s. `routes/web.php` also contains many commented-out route experiments — the live routes are what's uncommented.

### Livewire component layout (`app/Livewire/`)
- `Livewire/Admin/**` — the company-admin dashboard (fleet, ticket booking, cargo, data export, messaging).
- `Livewire/Enduser/**` — the customer-facing pages served under `/{company}`.
- `Livewire/Route/`, top-level components (`ManageFleet`, `ManageTicket`, `VehicleRegistration`, `BusinessForm`, etc.) — admin management screens.
- Volt single-file components live in `resources/views/livewire/**` and are routed with `Volt::route(...)` (used for the end-user login/register pages under `/{company}`).

### Shared booking logic via traits (`app/Trait/`)
`SharedTicketBooking` and `SharedBookingMethods` hold the bulk of booking state and behavior (schedule search, seat selection, fare calc, PDF ticket download, booking search) as Livewire traits mixed into both admin and end-user components. Fix booking bugs here, not in individual components. PDF slips render through `barryvdh/laravel-dompdf` from `resources/views/pdf/`.

### Theming & preview system
Companies pick a theme (`CompanyTheme`, `theme1`/`theme2`/...). The `/*-preview` routes and `resources/views/preview/**` render themed pages with a `?theme=` query param for the theme-picker UI in the business signup flow. `routes/preview.php` (required at the bottom of `web.php`) holds the admin demo-iframe routes.

### Data export
`app/Exports/**` uses `maatwebsite/excel`. `CompanyFullDataExport` (a `WithMultipleSheets` workbook) bundles per-company routes, vehicles, schedules, tickets, seats, and cargo bookings into one spreadsheet, scoped by `companyId` and an optional date range.

### Domain models
Core entities: `Company` (tenant root) → has many `Vehicle`, `Routes`, `VehicleSchedule`, `Ticket`, `Service` (via `company_services` pivot), plus cargo (`CargoBook`, `CargoRoute`, `CargoWeightTier`, `CargoVolumeTier`, `CargoServiceType`, `CargoImage`) and theming (`CompanyTheme`, `ColorPalette`, `CompanyColor`). A `Ticket` has `TicketSeat` rows. Almost every query is scoped `where('company_id', ...)` — preserve this scoping in any new query to maintain tenant isolation.

## Conventions

- The codebase has significant commented-out code and debugging leftovers (`dd()`, `@dd()`). Note `SharedTicketBooking::searchTickets()` currently ends in a `dd()` that halts execution — a live bug if you touch ticket search.
- Migrations are the source of truth for schema; there are per-column index files at the repo root (`index('status')`, etc.) that are stray artifacts, not code.
