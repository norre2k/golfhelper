<?php
namespace GolfHelper;

abstract class Player
{
    protected string $name;
    protected string $level;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string { return $this->name; }
    public function getLevel(): string { return $this->level; }

    abstract public function playingTips(): array;

    public function suggestClub(float $distance): string
    {
        $helper = new ClubHelper();
        return $helper->recommendClub($distance, $this->level);
    }
}
