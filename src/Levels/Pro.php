<?php
namespace GolfHelper\Levels;

use GolfHelper\Player;

class Pro extends Player
{
    protected string $level = 'Proffs';

    public function playingTips(): array
    {
        return [
            'Finslipa tekniska detaljer och mental träning.',
            'Analysera banan och planera varje hål noggrant.',
            'Optimera utrustning för din spelstil.'
        ];
    }
}
