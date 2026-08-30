<?php
namespace GolfHelper;

class Rules
{
    public function basicRules(): array
    {
        return [
            'Räkna poäng för varje hål och håll reda på antal slag.',
            'Spelaren närmast flaggan slår alltid först på green.',
            'Drop-regler: följ lokala banregler vid hinder.',
            'Respektera speltempo och andra spelare.'
        ];
    }
}
