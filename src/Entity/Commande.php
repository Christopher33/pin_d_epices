<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Count(min="1", max="10")
     * @Assert\PositiveOrZero
     */
    private $plat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero
     */
    private $dessert;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero
     */
    private $canette;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero
     */
    private $eau;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero
     */
    private $boisson;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlat(): ?int
    {
        return $this->plat;
    }

    public function setPlat(?int $plat): self
    {
        $this->plat = $plat;

        return $this;
    }

    public function getDessert(): ?int
    {
        return $this->dessert;
    }

    public function setDessert(?int $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }

    public function getCanette(): ?int
    {
        return $this->canette;
    }

    public function setCanette(?int $canette): self
    {
        $this->canette = $canette;

        return $this;
    }

    public function getEau(): ?int
    {
        return $this->eau;
    }

    public function setEau(?int $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function getBoisson(): ?int
    {
        return $this->boisson;
    }

    public function setBoisson(?int $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getUsers(): ?user
    {
        return $this->users;
    }

    public function setUsers(?user $users): self
    {
        $this->users = $users;

        return $this;
    }
}
