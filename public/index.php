<?php
require __DIR__ . '/../src/bootstrap.php';

session_start();

use GolfHelper\Levels\Beginner;
use GolfHelper\Levels\Intermediate;
use GolfHelper\Levels\Pro;
use GolfHelper\Rules;

$players = [
	'beginner' => Beginner::class,
	'intermediate' => Intermediate::class,
	'pro' => Pro::class,
];

$levels = [
	'beginner' => 'Nybörjare',
	'intermediate' => 'Van spelare',
	'pro' => 'Proffs',
];

$playerNameInput = $_POST['player_name'] ?? ($_SESSION['golfhelper_name'] ?? '');
$selectedLevel = $_POST['level'] ?? 'beginner';
$distanceInput = $_POST['distance'] ?? '';
$distance = filter_var($distanceInput, FILTER_VALIDATE_FLOAT);
$error = null;
$player = null;

$scorecardError = null;
$scorecardTotal = null;
$scorecardValues = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$cleanName = trim((string) $playerNameInput);
	if ($cleanName !== '') {
		$_SESSION['golfhelper_name'] = $cleanName;
	}

	if (!isset($players[$selectedLevel])) {
		$error = 'Välj en giltig spelarnivå.';
	} elseif ($distance === false || $distance < 1 || $distance > 400) {
		$error = 'Ange ett avstånd mellan 1 och 400 meter.';
	} else {
		$playerClass = $players[$selectedLevel];
		$playerName = $cleanName !== '' ? $cleanName : 'Du';
		$player = new $playerClass($playerName);
	}

	if (isset($_POST['scorecard_submit'])) {
		for ($hole = 1; $hole <= 9; $hole++) {
			$fieldName = 'hole_' . $hole;
			$value = filter_input(INPUT_POST, $fieldName, FILTER_VALIDATE_INT);
			$scorecardValues[$hole] = $value !== false ? (int) $value : null;
			if ($value === false || $value < 0 || $value > 20) {
				$scorecardError = 'Ange ett poängvärde mellan 0 och 20 för varje hål.';
			}
		}
		if ($scorecardError === null) {
			$scorecardTotal = array_sum($scorecardValues);
		}
	}
}

$rules = new Rules();

function escape(string $value): string
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

?><!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GolfHelper</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
	<div class="container">
		<p class="eyebrow">Ditt digitala golfstöd</p>
		<h1>GolfHelper</h1>
		<p class="intro">Praktiska tips, regler och hjälp med klubbval för din nivå.</p>
		<?php if (!empty($_SESSION['golfhelper_name'])): ?>
			<p class="welcome-banner">Hej <?php echo escape($_SESSION['golfhelper_name']); ?>, här är ditt personliga golfstöd.</p>
		<?php endif; ?>
	</div>
</header>

<main class="container">
	<section class="tool-panel" aria-labelledby="tool-title">
		<div>
			<p class="section-label">Klubbhjälp</p>
			<h2 id="tool-title">Vilken klubba passar slaget?</h2>
			<p>Välj din nivå och ange ungefär hur långt slaget är.</p>
	</div>

	<form method="post" class="club-form">
			<div class="form-grid">
				<label for="player_name">Namn
					<input id="player_name" name="player_name" type="text" value="<?php echo escape($_SESSION['golfhelper_name'] ?? ''); ?>" placeholder="Skriv ditt namn">
				</label>

				<label for="level">Spelnivå
					<select id="level" name="level" required>
						<?php foreach ($levels as $value => $label): ?>
							<option value="<?php echo escape($value); ?>" <?php echo $selectedLevel === $value ? 'selected' : ''; ?>>
								<?php echo escape($label); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</label>

				<label for="distance">Avstånd i meter
					<input id="distance" name="distance" type="number" min="1" max="400" step="1" value="<?php echo escape((string) $distanceInput); ?>" placeholder="Till exempel 135" required>
				</label>
			</div>
			<button type="submit">Hitta klubba</button>
		</form>

		<?php if ($error !== null): ?>
			<p class="message error" role="alert"><?php echo escape($error); ?></p>
		<?php elseif ($player !== null): ?>
			<div class="result" aria-live="polite">
				<p class="section-label">Ditt resultat</p>
				<h3><?php echo escape($player->getLevel()); ?>: prova <?php echo escape($player->suggestClub((float) $distance)); ?></h3>
				<p>För ett slag på <?php echo escape((string) $distance); ?> meter är detta en bra utgångspunkt. Anpassa alltid efter vind, läge och din egen slaglängd.</p>
			</div>
		<?php endif; ?>
	</section>

	<div class="content-grid">
		<section class="content-section" aria-labelledby="tips-title">
			<p class="section-label">Spelarstöd</p>
			<h2 id="tips-title">Tips för alla nivåer</h2>
			<div class="tips-grid">
				<?php foreach ($players as $playerClass): ?>
					<?php $examplePlayer = new $playerClass(''); ?>
					<article class="tip-card">
						<h3><?php echo escape($examplePlayer->getLevel()); ?></h3>
						<ul>
							<?php foreach ($examplePlayer->playingTips() as $tip): ?>
								<li><?php echo escape($tip); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="content-section" aria-labelledby="scorecard-title">
			<p class="section-label">Scorekort</p>
			<h2 id="scorecard-title">Hål 1–9</h2>
			<form method="post" class="scorecard-form">
				<input type="hidden" name="scorecard_submit" value="1">
				<div class="scorecard-grid">
					<?php for ($hole = 1; $hole <= 9; $hole++): ?>
						<label for="hole_<?php echo $hole; ?>">Hål <?php echo $hole; ?>
							<input id="hole_<?php echo $hole; ?>" name="hole_<?php echo $hole; ?>" type="number" min="0" max="20" value="<?php echo escape((string) ($scorecardValues[$hole] ?? '')); ?>" required>
						</label>
					<?php endfor; ?>
				</div>
				<button type="submit">Räkna total</button>
			</form>

			<?php if ($scorecardError !== null): ?>
				<p class="message error" role="alert"><?php echo escape($scorecardError); ?></p>
			<?php elseif ($scorecardTotal !== null): ?>
				<div class="result">
					<p class="section-label">Total</p>
					<h3><?php echo escape((string) $scorecardTotal); ?> slag på 9 hål</h3>
					<p>Genomsnitt per hål: <?php echo escape(number_format($scorecardTotal / 9, 1)); ?></p>
				</div>
			<?php endif; ?>
		</section>

		<section class="content-section rules-section" aria-labelledby="rules-title">
			<p class="section-label">På banan</p>
			<h2 id="rules-title">Grundregler</h2>
			<ul class="rules-list">
				<?php foreach ($rules->basicRules() as $rule): ?>
					<li><?php echo escape($rule); ?></li>
				<?php endforeach; ?>
			</ul>
		</section>
	</div>
</main>
</body>
</html>
