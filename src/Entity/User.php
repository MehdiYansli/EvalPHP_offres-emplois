<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Apply::class, mappedBy: 'user_id')]
    private Collection $applies;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Apply::class)]
    private Collection $appliesJob;

    public function __construct()
    {
        $this->applies = new ArrayCollection();
        $this->appliesJob = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getApplies(): Collection
    {
        return $this->applies;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getAppliesJob(): Collection
    {
        return $this->appliesJob;
    }

    public function addAppliesJob(Apply $appliesJob): self
    {
        if (!$this->appliesJob->contains($appliesJob)) {
            $this->appliesJob->add($appliesJob);
            $appliesJob->setUserId($this);
        }

        return $this;
    }

    public function removeAppliesJob(Apply $appliesJob): self
    {
        if ($this->appliesJob->removeElement($appliesJob)) {
            // set the owning side to null (unless already changed)
            if ($appliesJob->getUserId() === $this) {
                $appliesJob->setUserId(null);
            }
        }

        return $this;
    }

}
