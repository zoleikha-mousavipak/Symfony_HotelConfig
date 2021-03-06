<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\HotelGroup;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    private $hotels;

    private $groups;

    public function load(ObjectManager $manager)
    {
        $this->loadGroups($manager);
        $this->loadHotels($manager);
        $this->loadReviews($manager);
        $manager->flush();
    }

    public function loadHotels($manager)
    {
        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz 1');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');
        $hotel->setGroup($this->groups[0]);

        $manager->persist($hotel);
        $this->hotels[] = $hotel;

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz 2 ');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');
        $hotel->setGroup($this->groups[0]);

        $manager->persist($hotel);
        $this->hotels[] = $hotel;

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Alexanderplatz 3');
        $hotel->setAddress('Alexanderplatz 1, 10409, Berlin');
        $hotel->setGroup($this->groups[0]);

        $manager->persist($hotel);
        $this->hotels[] = $hotel;

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Karolingerplatz');
        $hotel->setAddress('Karolingerplatz 1, 10409, Berlin');

        $manager->persist($hotel);
        $this->hotels[] = $hotel;

        $hotel = new Hotel();
        $hotel->setId(Uuid::uuid4());
        $hotel->setName('Hotel Centro');
        $hotel->setAddress('Karolingerplatz 1, 10409, Berlin');

        $manager->persist($hotel);
        $this->hotels[] = $hotel;
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

    public function loadGroups($manager)
    {
        $group = new HotelGroup();

        $group->setName('Alexanderplatz')
            ->setId(Uuid::uuid4());

        $manager->persist($group);
        $this->groups[] = $group;
    }
}
