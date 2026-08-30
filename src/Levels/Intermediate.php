<?php
namespace GolfHelper\Levels;

use GolfHelper\Player;

class Intermediate extends Player
{
    protected string $level = 'Van spelare';

    public function playingTips(): array
    {
        return [
            'Variera klubbor för att utveckla precision.',
            'Arbeta på bana management och läsning av green.',
            'Bygg upp konsekvent uppvärmning.'
        ];
    }
}
