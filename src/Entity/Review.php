<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var Hotel
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="reviews")
     */
    private $hotel;


    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Hotel
     */
    public function getHotel(): Hotel
    {
        return $this->hotel;
    }

    /**
     * @param Hotel $hotel
     * @return Review
     */
    public function setHotel(Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }


}
