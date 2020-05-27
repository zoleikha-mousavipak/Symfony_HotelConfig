<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadHotels($manager);
        $this->loadReviews($manager);
        $manager->flush();
    }

    public function loadHotels($manager)
    {
        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');

        $manager->persist($hotel);

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');

        $manager->persist($hotel);

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');

        $manager->persist($hotel);

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');

        $manager->persist($hotel);

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');

        $manager->persist($hotel);
    }

    public function loadReviews($manager)
    {
        // hotel 1
        $review = new Review();
        $review->setHotel($this->hotels[0]);
        $review->setComment('Very nice stay');
        $review->setScore(10);
        $manager->persist($review);

        $review = new Review();
        $review->setHotel($this->hotels[0]);
        $review->setComment('Average');
        $review->setScore(5);
        $manager->persist($review);

        $review = new Review();
        $review->setHotel($this->hotels[0]);
        $review->setComment('Very nice stay, I enjoyed it a lot.');
        $review->setScore(9);
        $manager->persist($review);

        $review = new Review();
        $review->setHotel($this->hotels[0]);
        $review->setComment('Worst experience ever.');
        $review->setScore(1);
        $manager->persist($review);

        // hotel 2
        $review = new Review();
        $review->setHotel($this->hotels[1]);
        $review->setComment('The receptionist was not smiling.');
        $review->setScore(5);
        $manager->persist($review);

        $review = new Review();
        $review->setHotel($this->hotels[1]);
        $review->setComment('Very nice stay, the reception was really fast.');
        $review->setScore(10);
        $manager->persist($review);
    }
}
