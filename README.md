# Dad Jokes

A trivial offline flashcard PWA for memorizing dad jokes — front of the card is
a keyword prompt, back is the joke. Built as the proving ground for
[`survos/mobile-bundle`](https://github.com/survos/mobile-bundle)'s new
`#[MobilePage]` attribute + Framework7/Dexie app-shell tooling.

## Stack

- Symfony 8.1 / PHP 8.5, AssetMapper (no JS build step).
- `survos/fw-bundle` (Framework7 chrome) + `survos/js-twig-bundle` (Dexie sync)
  + `survos/mobile-bundle` (`#[MobilePage]` attribute, generic app-shell
  controller) + `spomky-labs/pwa-bundle` (installable/offline).
- `Joke` entity via ApiPlatform (`GET /api/jokes`), Postgres. Its default
  Hydra collection shape (`{member, view.next}`) is exactly what
  `js-twig-bundle`'s `DbUtilities` expects for Dexie sync — no glue needed.
- Review scheduling is a client-side port of `~/sites/anki`'s Leitner-box
  algorithm (`assets/lib/leitner.js`, mirrors `UserWord::grade()`) — all
  review state lives in IndexedDB (`db.progress`), no server round-trip to
  grade a card.

## Local dev

```bash
docker compose up -d database        # Postgres — matches prod (dokku-postgres)
composer install
php bin/console doctrine:migrations:migrate -n
php bin/console app:seed-jokes       # idempotent, safe to re-run
symfony server:start -d
```

`.env.local` (gitignored) points `DATABASE_URL` at the docker-compose
Postgres container's mapped port — check `docker compose port database 5432`
if it's not `32769`.

## Adding a page

```php
use Survos\MobileBundle\Attribute\MobilePage;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pages/whatever', name: 'app_whatever')]
#[MobilePage(title: 'Whatever', icon: 'tabler:whatever', tab: 'study')]
public function whatever(): Response { ... }
```

picked up automatically by `mobile_pages`/`@SurvosMobile/tabbar.html.twig` —
see `mobile-bundle`'s own README for the full attribute/registry story.

## Deploy

`survos/deployment-bundle` (dev-only) + Dokku, app name `dadjokes` on
`ssh.survos.com` → `dadjokes.survos.com`. `dokku-postgres` addon
(`dadjokes-db`) is created + linked separately (not auto-provisioned from
`app.json`'s `addons` list on this host):

```bash
bin/console dokku deploy --force   # or: git push dokku main directly —
                                    # the console wrapper needs a real TTY
```

After the first deploy on a fresh DB: `ssh dokku@ssh.survos.com run dadjokes bin/console app:seed-jokes`.

## Known gaps

- No F7 client-side routing wired (single page, server-rendered inline into
  `.view-main` — see `templates/start.html.twig`'s comment). `mobile-bundle`'s
  `routes`/`mainUrl` Stimulus values support it for a second page.
- `dokku-redis` addon is declared in `app.json` but nothing uses it yet.
- Packagist's `survos/mobile-bundle` package metadata still points at the
  old `SurvosMobileBundle` repo name, so `composer.json` pins the real
  `github.com/survos/mobile-bundle` via a `repositories` VCS entry on
  `dev-main` until that's fixed upstream.
