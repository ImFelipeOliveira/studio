<?php

namespace App\Entity;

use App\Entity\Enum\ArtistRoleEnum;
use App\Entity\Studio;
use App\Entity\User;
use App\Repository\ArtistRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\ManyToOne(inversedBy: 'artists', targetEntity: Studio::class)]
    private Studio $studio;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $profile = null;

    #[ORM\Column(type: "string", enumType: ArtistRoleEnum::class)]
    private ArtistRoleEnum $role;

    #[ORM\Column(type: "datetime", nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(type: "datetime", nullable: false)]
    private DateTime $updatedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user 
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Studio
     */
    public function getStudio(): Studio
    {
        return $this->studio;
    }

    /**
     * @param Studio $studio 
     * @return self
     */
    public function setStudio(Studio $studio): self
    {
        $this->studio = $studio;
        return $this;
    }

    /**
     * @return 
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * @param  $bio 
     * @return self
     */
    public function setBio(?string $bio): self
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return 
     */
    public function getProfile(): ?string
    {
        return $this->profile;
    }

    /**
     * @param  $profile 
     * @return self
     */
    public function setProfile(?string $profile): self
    {
        $this->profile = $profile;
        return $this;
    }

    /**
     * @return ArtistRoleEnum
     */
    public function getRole(): ArtistRoleEnum
    {
        return $this->role;
    }

    /**
     * @param ArtistRoleEnum $role 
     * @return self
     */
    public function setRole(ArtistRoleEnum $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): self
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new DateTime();
        return $this;
    }
}
