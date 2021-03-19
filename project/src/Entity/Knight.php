<?php

namespace App\Entity;

use App\Repository\KnightRepository;
use App\Entity\AbstractHuman;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KnightRepository::class)
 */
class Knight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weaponPower;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    { 
        $this->name = $name;
        
        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getWeaponPower(): ?int
    {
        return $this->weaponPower;
    }

    public function setWeaponPower(?int $weaponPower): self
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }
}
