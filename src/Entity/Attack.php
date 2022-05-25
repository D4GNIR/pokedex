<?php

namespace App\Entity;

use App\Repository\AttackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttackRepository::class)]
class Attack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Label;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\ManyToMany(targetEntity: Pokemon::class, mappedBy: 'attacks')]
    private $pokemon;

    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'Attacks')]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    private $Category;

    #[ORM\Column(type: 'string', length: 255)]
    private $Power;

    #[ORM\Column(type: 'string', length: 255)]
    private $Accuracy;

    #[ORM\Column(type: 'string', length: 255)]
    private $PP;

    #[ORM\Column(type: 'string', length: 255)]
    private $MakesContact;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(string $Label): self
    {
        $this->Label = $Label;

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

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemon $pokemon): self
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon[] = $pokemon;
            $pokemon->addAttack($this);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): self
    {
        if ($this->pokemon->removeElement($pokemon)) {
            $pokemon->removeAttack($this);
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->Power;
    }

    public function setPower(string $Power): self
    {
        $this->Power = $Power;

        return $this;
    }

    public function getAccuracy(): ?string
    {
        return $this->Accuracy;
    }

    public function setAccuracy(string $Accuracy): self
    {
        $this->Accuracy = $Accuracy;

        return $this;
    }

    public function getPP(): ?string
    {
        return $this->PP;
    }

    public function setPP(string $PP): self
    {
        $this->PP = $PP;

        return $this;
    }

    public function getMakesContact(): ?string
    {
        return $this->MakesContact;
    }

    public function setMakesContact(string $MakesContact): self
    {
        $this->MakesContact = $MakesContact;

        return $this;
    }
}
