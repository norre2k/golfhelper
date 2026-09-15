<?php
require __DIR__ . '/../src/bootstrap.php';

use GolfHelper\ScoreStatistics;

function fail(string $message): void
{
    throw new RuntimeException($message);
}

$stats = new ScoreStatistics([3, 5, 4, 7, 5, 6, 3, 4, 5]);

if (round($stats->getTotal(), 2) !== 42.0) {
    fail('Total should be 42');
}

if (round($stats->getAverage(), 2) !== 4.67) {
    fail('Average should be 4.67');
}

if ($stats->getBestHole() !== 3) {
    fail('Best hole should be 3');
}

if ($stats->getWorstHole() !== 7) {
    fail('Worst hole should be 7');
}

echo "Scorecard stats test passed\n";
