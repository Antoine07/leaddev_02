<?php

class Square
{
    private array $points = [];

    public function __construct(
        ...$points
    ) {
        if (count($points) != 4) throw new Exception("Error Processing Request", 1);

        $this->points = $points;
    }

    public function area()
    {
        $distance = sqrt((($this->points[1])->getX() - ($this->points[1])->getY()) ** 2);

        return $distance * $distance;
    }
}
