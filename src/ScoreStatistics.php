<?php
namespace GolfHelper;

class ScoreStatistics
{
    private array $scores;

    public function __construct(array $scores)
    {
        $this->scores = [];

        foreach ($scores as $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $parsed = filter_var($value, FILTER_VALIDATE_INT);
            if ($parsed !== false) {
                $this->scores[] = max(0, (int) $parsed);
            }
        }
    }

    public function getTotal(): int
    {
        return array_sum($this->scores);
    }

    public function getAverage(): float
    {
        if ($this->scores === []) {
            return 0.0;
        }

        return round(array_sum($this->scores) / count($this->scores), 2);
    }

    public function getBestHole(): int
    {
        if ($this->scores === []) {
            return 0;
        }

        return min($this->scores);
    }

    public function getWorstHole(): int
    {
        if ($this->scores === []) {
            return 0;
        }

        return max($this->scores);
    }
}
