<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Human
 *
 * To extend for the humans warrior
 *
 * @ORM\MappedSuperclass
 */
abstract class Human
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;
    /**
     * Set name
     *
     * @param string $name
     * @return Human
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
