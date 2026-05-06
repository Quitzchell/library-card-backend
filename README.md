# Filament Backend

> **Note:** This is a public copy of a private repository, published for portfolio purposes. Secrets and internal history have been stripped.

Backend admin and API for Library Card using Laravel + Filament.

## Quick Start

### Prerequisites
- Docker Desktop installed and running
- A Postgres instance reachable at `host.docker.internal:5433` (or update `src/.env`)

### First Time Setup

1. **Copy env file:**
   ```bash
   cp src/.env.example src/.env
   ```

2. **Build and start the container:**
   ```bash
   make up
   ```

3. **Install PHP dependencies:**
   ```bash
   make shell
   composer install
   ```

4. **Generate app key and run migrations:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Create an admin user:**
   ```bash
   php artisan make:filament-user
   ```

6. **Access the app:**
   - Admin panel: http://localhost:8080/admin
   - Public API: http://localhost:8080/api

### Daily Development

```bash
# Start container (rebuilds on Dockerfile changes)
make up

# Stop container
make down

# Open a shell inside the container
make shell
```

## Common Commands

All `php artisan` commands run inside the container. Either open `make shell` first or prefix with `docker compose exec development`.

### Artisan

```bash
# Run any artisan command
php artisan <command>

# Examples:
php artisan migrate
php artisan make:migration create_things_table
php artisan tinker
php artisan make:filament-resource Thing
php artisan make:filament-user
```

### Container Management

```bash
# View logs
docker compose logs -f development

# Rebuild after Dockerfile changes (also done by `make up`)
docker compose build development

# Restart the container
docker compose restart
```

### Database

```bash
# Connect to the host Postgres from your machine
psql -h localhost -p 5433 -U postgres -d library_card

# Backup
pg_dump -h localhost -p 5433 -U postgres library_card > backup.sql
```

## Project Structure

```
library-card-filament/
├── docker-compose.yml      # Dev container
├── Dockerfile              # Production image (Render)
├── Dockerfile.dev          # Dev image
├── Makefile                # up / down / shell shortcuts
├── render.yaml             # Render blueprint
├── server/                 # nginx config for prod image
└── src/                    # Laravel application
    ├── app/
    │   ├── Enums/          # PlatformType, Team, VideoType, …
    │   ├── Filament/       # Admin pages, resources, custom form components
    │   ├── Http/
    │   │   ├── Controllers/Api/   # Public read-only JSON API
    │   │   └── Resources/         # API response shapes
    │   ├── Models/         # Eloquent models (Music, TourDate, Video, …)
    │   ├── Services/       # ImageOptimizer, Revalidation, …
    │   └── Settings/       # Spatie Settings (BiographySettings)
    ├── config/
    ├── database/
    │   ├── migrations/
    │   └── settings/       # Spatie Settings migrations
    ├── routes/
    │   ├── api.php         # /api/* read endpoints for the Next.js frontend
    │   └── web.php
    └── .env.example
```

## API Endpoints

Read-only JSON endpoints under `/api`, consumed by the Next.js frontend:

- `GET /api/about`
- `GET /api/biography-images`
- `GET /api/music` · `GET /api/music/{id}`
- `GET /api/tour-dates` · `/upcoming` · `/past` · `/{id}`
- `GET /api/videos`
- `GET /api/team-members?team=bookings|management|promotion`
- `GET /api/social-accounts`

CORS allows origins listed in `FRONTEND_URL` (comma-separated).

## Next Steps

1. Filament docs: https://filamentphp.com/docs
2. Laravel docs: https://laravel.com/docs
3. Match models and API resources to `frontend/lib/interfaces/`