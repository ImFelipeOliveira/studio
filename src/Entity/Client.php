<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clients', targetEntity: Studio::class)]
    private Studio $studio;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(nullable: false)]
    private string $email;

    #[ORM\Column(nullable: false)]
    private string $phoneNumber;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(nullable: false)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: false)]
    private \DateTimeImmutable $updatedAt;

    #[ORM\UniqueConstraint(name: "unique_email_per_studio", columns: ["email", "studio"])]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudio(): Studio
    {
        return $this->studio;
    }

    public function setStudio(Studio $studio): self
    {
        $this->studio = $studio;
        return $this;
    }

    /**
     * @return 
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  $name 
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber 
     * @return self
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }


    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
