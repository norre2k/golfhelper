# GolfHelper (demo)

En enkel PHP-applikation som hjälper golfspelare på olika nivåer. Den här versionen innehåller en grundstruktur med nivåklasser, regler och en enkel klubbrekommendation.

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

Nästa steg du kan be mig göra:
- Koppla en RSS/API-aggregator för golfnyheter
- Lägga till formulär för användarprofiler och sparade preferenser
- Förbättra klubbrekommendation med spelardata och klubbgenskapsprofiler
