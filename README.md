# GolfHelper

GolfHelper är en PHP-applikation som fungerar som ett digitalt hjälpmedel för golfspelare på olika nivåer. Projektet samlar grundläggande golfkunskap på en plats och är tänkt att hjälpa användaren att utvecklas, förstå spelet bättre och välja rätt klubba i olika situationer.

Applikationen riktar sig till tre typer av spelare:

- **Nybörjare** får enkla tips om sving, balans, klubbor och korta slag.
- **Vana spelare** får stöd kring klubbval, banstrategi och speltempo.
- **Proffs** får mer avancerade tips om teknik, mental träning och planering.

Projektet innehåller även en grundläggande regelsida och en klubbrekommendation som utgår från slagets avstånd och spelarens nivå. Webbgränssnittet visar just nu exempel på spelarnivåer, golfregler och rekommenderade klubbor.

GolfHelper är uppbyggt med PHP-klasser för att funktionerna ska kunna utvecklas och användas i fler delar av applikationen.

Snabbstart (Windows, XAMPP):

1. Placera projektmappen i din XAMPP `htdocs` (om inte redan där).
2. (Rekommenderat) Kör `composer install` i projektroten för PSR-4-autoload (om du har Composer):

```bash
composer install
```

3. Starta Apache i XAMPP och öppna i webbläsaren:

```
http://localhost/myProjects/golfhelper/public/
```

Om du inte kör `composer install` använder koden en inbyggd autoloader (`src/bootstrap.php`).

Filer att titta på:
- [src/Player.php](src/Player.php) — basklass för spelare
- [src/Levels/Beginner.php](src/Levels/Beginner.php) — nybörjare
- [src/Levels/Intermediate.php](src/Levels/Intermediate.php) — van spelare
- [src/Levels/Pro.php](src/Levels/Pro.php) — proffs
- [src/ClubHelper.php](src/ClubHelper.php) — klubbrekommendation
- [src/Rules.php](src/Rules.php) — enkla regler
- [public/index.php](public/index.php) — demo-UI

