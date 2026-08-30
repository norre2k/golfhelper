<?php
namespace GolfHelper\Levels;

use GolfHelper\Player;

class Beginner extends Player
{
    protected string $level = 'Nybörjare';

    public function playingTips(): array
    {
        return [
            'Fokusera på enkel sving och balans.',
            'Välj en klubba som ger kontroll framför längd.',
            'Öva korta slag och putting.'
        ];
    }
}
