<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelGroupRepository")
 */
class HotelGroup
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")hotel
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hotel", mappedBy="group")
     */
    private $hotels;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return HotelGroup
     */
    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return HotelGroup
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getHotels(): PersistentCollection
    {
        return $this->hotels;
    }

    /**
     * @param Hotel[] $hotels
     * @return HotelGroup
     */
    public function setHotels(array $hotels): self
    {
        $this->hotels = $hotels;

        return $this;
    }
}
