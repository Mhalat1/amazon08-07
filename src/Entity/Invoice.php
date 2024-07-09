<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'invoice', cascade: ['persist', 'remove'])]
    private ?Order $commande = null;

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

    public function getCommande(): ?Order
    {
        return $this->commande;
    }

    public function setCommande(?Order $commande): static
    {
        // unset the owning side of the relation if necessary
        if ($commande === null && $this->commande !== null) {
            $this->commande->setInvoice(null);
        }

        // set the owning side of the relation if necessary
        if ($commande !== null && $commande->getInvoice() !== $this) {
            $commande->setInvoice($this);
        }

        $this->commande = $commande;

        return $this;
    }
}
