# Dad Jokes

An offline flashcard PWA for memorizing dad jokes — front of the card is a
keyword prompt, back is the joke. Built as the proving ground for
[`survos/mobile-bundle`](https://github.com/survos/mobile-bundle)'s new
`#[MobilePage]` attribute + Framework7/Dexie app-shell tooling.

## Features

- **Review** — flip-card study loop, [FSRS](https://github.com/open-spaced-repetition/ts-fsrs)
  spaced-repetition scheduling (Again/Hard/Good/Easy), streak tracking.
- **Cards** — browse the full deck, filter by category, tap to reveal.
- **Settings** — pick which category to study, tune FSRS desired retention,
  see streak/review stats, reset progress, jump to admin.
- **Admin** (`/admin/jokes`) — plain server-rendered CRUD for the deck.

## Stack

- Symfony 8.1 / PHP 8.5, AssetMapper (no JS build step).
- `survos/fw-bundle` (Framework7 chrome) + `survos/js-twig-bundle` (Dexie sync)
  + `survos/mobile-bundle` (`#[MobilePage]` attribute, generic app-shell
  controller) + `spomky-labs/pwa-bundle` (installable/offline).
- `Joke` entity via ApiPlatform (`GET /api/jokes`), Postgres. Its default
  Hydra collection shape (`{member, view.next}`) is exactly what
  `js-twig-bundle`'s `DbUtilities` expects for Dexie sync — no glue needed.
- Review scheduling is `ts-fsrs` (MIT, browser-ready ESM, via importmap) —
  same algorithm `~/sites/anki`'s roadmap wants and what
  `kirill-markin/flashcards-open-source-app` uses for real. All review state
  (FSRS card fields) and streak stats live in IndexedDB (`db.progress`,
  `db.stats`) — no server round-trip to grade a card.
- Admin CRUD is plain Symfony forms (`symfony/form` + `symfony/security-csrf`),
  no SPA — matches the ecosystem's admin-favors-pages convention.

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
public function whatever(): Response
{
    return $this->render('pages/whatever.html.twig', $this->shellContext());
}
```

picked up automatically by `mobile_pages`/`@SurvosMobile/tabbar.html.twig` —
see `mobile-bundle`'s own README for the full attribute/registry story. New
page templates should `{% extends '_shell.html.twig' %}` and fill the `page`
block (see `templates/pages/*.html.twig`) — each tab is a real full-page
navigation, not an F7 XHR route (simpler and more robust for a handful of
tabs; `mobile-bundle`'s `routes`/`mainUrl` Stimulus values are there if a
true SPA transition is ever worth the complexity).

## Deploy

`survos/deployment-bundle` (dev-only) + Dokku, app name `dadjokes` on
`ssh.survos.com` → `dadjokes.survos.com`. `dokku-postgres` addon
(`dadjokes-db`) is created + linked separately (not auto-provisioned from
`app.json`'s `addons` list on this host):

```bash
bin/console dokku deploy --force   # or: git push dokku main directly —
                                    # the console wrapper needs a real TTY
```

After any deploy that adds jokes/categories: `ssh dokku@ssh.survos.com run dadjokes bin/console app:seed-jokes`
(idempotent — matches by keyword, updates category/text, safe to re-run).

## Known gaps

- No auth on `/admin/jokes` — fine while this is a single-operator toy app,
  a real blocker before sharing the admin URL with anyone else.
- `dokku-redis` addon is declared in `app.json` but nothing uses it yet.
- Packagist's `survos/mobile-bundle` package metadata still points at the
  old `SurvosMobileBundle` repo name, so `composer.json` pins the real
  `github.com/survos/mobile-bundle` via a `repositories` VCS entry on
  `dev-main` until that's fixed upstream.
- Dexie's schema version is hardcoded to `1` in `js-twig-bundle`'s
  `DbUtilities` — adding a new IndexedDB store (like `stats` here) means
  existing local databases won't pick it up without deleting them
  (`indexedDB.deleteDatabase('dadjokes')`) or upgrade behavior in that
  bundle changing. Not an issue for now (no real users yet).
