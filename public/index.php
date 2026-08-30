<?php
require __DIR__ . '/../src/bootstrap.php';

use GolfHelper\Levels\Beginner;
use GolfHelper\Levels\Intermediate;
use GolfHelper\Levels\Pro;
use GolfHelper\Rules;

$beg = new Beginner('Anna');
$int = new Intermediate('Björn');
$pro = new Pro('Cecilia');

$rules = new Rules();

?><!doctype html>
<html lang="sv">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>GolfHelper — demo</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>GolfHelper — demo</h1>

<section>
<h2>Spelarnivåer</h2>
<div class="card">
<h3><?php echo $beg->getName() ?> — <?php echo $beg->getLevel() ?></h3>
<p>Tips:</p>
<ul>
<?php foreach ($beg->playingTips() as $t): ?><li><?php echo $t ?></li><?php endforeach; ?>
</ul>
<p>Rekommenderad klubba för 120m: <?php echo $beg->suggestClub(120) ?></p>
</div>

<div class="card">
<h3><?php echo $int->getName() ?> — <?php echo $int->getLevel() ?></h3>
<ul>
<?php foreach ($int->playingTips() as $t): ?><li><?php echo $t ?></li><?php endforeach; ?>
</ul>
<p>Rekommenderad klubba för 220m: <?php echo $int->suggestClub(220) ?></p>
</div>

<div class="card">
<h3><?php echo $pro->getName() ?> — <?php echo $pro->getLevel() ?></h3>
<ul>
<?php foreach ($pro->playingTips() as $t): ?><li><?php echo $t ?></li><?php endforeach; ?>
</ul>
<p>Rekommenderad klubba för 280m: <?php echo $pro->suggestClub(280) ?></p>
</div>
</section>

<section>
<h2>Regler (kort)</h2>
<ul>
<?php foreach ($rules->basicRules() as $r): ?><li><?php echo $r ?></li><?php endforeach; ?>
</ul>
</section>

<section>
<h2>Golfnyheter</h2>
<p>Här kan du senare lägga in en RSS- eller API-aggregator för nyheter.</p>
</section>

</body>
</html>
