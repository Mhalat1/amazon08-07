<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    /**
     * @var Collection<int, Commercants>
     */
    #[ORM\ManyToMany(targetEntity: Commercants::class, mappedBy: 'panier')]
    private Collection $paniercommercant;

    /**
     * @var Collection<int, Visiteurs>
     */
    #[ORM\ManyToMany(targetEntity: Visiteurs::class, mappedBy: 'panier')]
    private Collection $paniervisiteur;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function __construct()
    {
        $this->paniercommercant = new ArrayCollection();
        $this->paniervisiteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Commercants>
     */
    public function getPaniercommercant(): Collection
    {
        return $this->paniercommercant;
    }

    public function addPaniercommercant(Commercants $paniercommercant): static
    {
        if (!$this->paniercommercant->contains($paniercommercant)) {
            $this->paniercommercant->add($paniercommercant);
            $paniercommercant->addPanier($this);
        }

        return $this;
    }

    public function removePaniercommercant(Commercants $paniercommercant): static
    {
        if ($this->paniercommercant->removeElement($paniercommercant)) {
            $paniercommercant->removePanier($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Visiteurs>
     */
    public function getPaniervisiteur(): Collection
    {
        return $this->paniervisiteur;
    }

    public function addPaniervisiteur(Visiteurs $paniervisiteur): static
    {
        if (!$this->paniervisiteur->contains($paniervisiteur)) {
            $this->paniervisiteur->add($paniervisiteur);
            $paniervisiteur->addPanier($this);
        }

        return $this;
    }

    public function removePaniervisiteur(Visiteurs $paniervisiteur): static
    {
        if ($this->paniervisiteur->removeElement($paniervisiteur)) {
            $paniervisiteur->removePanier($this);
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
