<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id()
     * @var UuidInterface
     *
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="hotel", fetch="EAGER")
     */
    private $reviews;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HotelGroup", inversedBy="hotels", fetch="LAZY")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=true)
     */
    private $group;


    public function getId(): string
    {
        return $this->id->toString();
    }

    public function setId(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getReviews(): PersistentCollection
    {
        return $this->reviews;
    }

    /**
     * @param Review $reviews
     * @return Hotel
     */
    public function setReviews(Review $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * @param HotelGroup $group
     * @return Hotel
     */
    public function setGroup(HotelGroup $group): self
    {
        $this->group = $group;

        return $this;
    }
}
