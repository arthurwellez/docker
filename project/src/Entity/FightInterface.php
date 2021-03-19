<?php

namespace App\Entity;

interface FightInterface
{
    /**
     * Get the ID
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Calculate the Power Level of the Fighter
     *
     * @return int
     */
    public function calculatePowerLevel(): int;
}
