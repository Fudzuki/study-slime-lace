<?php
class Slime {
    private int $position = 0;
    private string $name;
    private string $footprints;

    function __construct(array $slime){
        $this->name = $slime['name'];
        $this->footprints = $slime['footprints'];
    }

    function getPosition(): int
    {
        return $this->position;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getFootprints(): string
    {
        return $this->footprints;
    }

    function run(): void
    {
        $this->position += mt_rand(-1, 3);
    }
}