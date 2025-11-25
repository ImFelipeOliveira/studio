<?php

namespace App\Entity;

use App\Entity\Enum\StudioTypeEnum;
use App\Repository\StudioRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudioRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Studio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: "studio", targetEntity: Artist::class)]
    private Collection $artists;

    #[ORM\OneToMany(mappedBy: "studio", targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\Column(name: "type", type: Types::STRING)]
    private StudioTypeEnum $type;

    #[ORM\OneToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column(type: "datetime", nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(type: "datetime", nullable: false)]
    private DateTime $updatedAt;


    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->setStudio($this);
        }

        return $this;
    }

    /**
     * @return StudioTypeEnum
     */
    public function getType(): StudioTypeEnum
    {
        return $this->type;
    }

    /**
     * @param StudioTypeEnum $type 
     * @return self
     */
    public function setType(StudioTypeEnum $type): self
    {
        $this->type = $type;
        return $this;
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
