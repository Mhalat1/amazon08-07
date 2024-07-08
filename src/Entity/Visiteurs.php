<?php

namespace App\Entity;

use App\Repository\VisiteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiteursRepository::class)]
class Visiteurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Articles>
     */
    #[ORM\ManyToMany(targetEntity: Articles::class, inversedBy: 'paniervisiteur')]
    private Collection $panier;

    public function __construct()
    {
        $this->panier = new ArrayCollection();
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

    /**
     * @return Collection<int, Articles>
     */
    public function getPanier(): Collection
    {
        return $this->panier;
    }

    public function addPanier(Articles $panier): static
    {
        if (!$this->panier->contains($panier)) {
            $this->panier->add($panier);
        }

        return $this;
    }

    public function removePanier(Articles $panier): static
    {
        $this->panier->removeElement($panier);

        return $this;
    }
}
