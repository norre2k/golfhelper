<?php
namespace GolfHelper;

class ClubHelper
{
    protected array $clubMap = [
        'Driver' => [220, 300],
        '3-wood' => [180, 220],
        '5-wood' => [160, 185],
        '3-iron' => [150, 170],
        '5-iron' => [130, 150],
        '7-iron' => [110, 130],
        '9-iron' => [90, 110],
        'Pitching wedge' => [60, 95],
        'Sand wedge' => [10, 80],
        'Putter' => [0, 20],
    ];

    public function recommendClub(float $distance, string $level = ''): string
    {
        $modifier = match ($level) {
            'Nybörjare' => -10,
            'Van spelare' => 0,
            'Proffs' => 10,
            default => 0,
        };
        $d = $distance + $modifier;
        foreach ($this->clubMap as $club => [$min, $max]) {
            if ($d >= $min && $d <= $max) {
                return $club;
            }
        }
        return 'Okänt: prova en mellan-klubba';
    }
}
