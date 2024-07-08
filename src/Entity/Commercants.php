<?php

namespace App\Entity;

use App\Repository\CommercantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommercantsRepository::class)]
class Commercants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    public ?string $name = null;

    /**
     * @var Collection<int, Articles>
     */
    #[ORM\ManyToMany(targetEntity: Articles::class, inversedBy: 'paniercommercant')]
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
