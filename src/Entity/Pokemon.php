<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\Column(type: 'integer')]
    private $numeroNationnal;

    #[ORM\Column(type: 'integer')]
    private $numeroPokedex;

    #[ORM\ManyToOne(targetEntity: Generation::class, inversedBy: 'pokemon')]
    #[ORM\JoinColumn(nullable: false)]
    private $generation;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon')]
    private $types;

    #[ORM\ManyToMany(targetEntity: Attack::class, inversedBy: 'pokemon')]
    private $attacks;

    #[ORM\Column(type: 'string', length: 255)]
    private $picture;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->attacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNumeroNationnal(): ?int
    {
        return $this->numeroNationnal;
    }

    public function setNumeroNationnal(int $numeroNationnal): self
    {
        $this->numeroNationnal = $numeroNationnal;

        return $this;
    }

    public function getNumeroPokedex(): ?int
    {
        return $this->numeroPokedex;
    }

    public function setNumeroPokedex(int $numeroPokedex): self
    {
        $this->numeroPokedex = $numeroPokedex;

        return $this;
    }

    public function getGeneration(): ?Generation
    {
        return $this->generation;
    }

    public function setGeneration(?Generation $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, Attack>
     */
    public function getAttacks(): Collection
    {
        return $this->attacks;
    }

    public function addAttack(Attack $attack): self
    {
        if (!$this->attacks->contains($attack)) {
            $this->attacks[] = $attack;
        }

        return $this;
    }

    public function removeAttack(Attack $attack): self
    {
        $this->attacks->removeElement($attack);

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
