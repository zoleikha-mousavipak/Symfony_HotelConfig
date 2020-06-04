<?php

namespace App\Service;

use App\Entity\Hotel;
use App\Entity\Review;
use App\Repository\HotelRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class HotelService
{

    /** @var HotelRepository */
    protected $hotelRepository;

    /** @var ReviewRepository */
    protected $reviewRepository;

    /** @var AdapterInterface */
    private $cache;

    const CACHE_PREFIX = 'hotel_';

    const CACHE_TTL = 60 * 60; // 1 hour

    public function __construct(EntityManagerInterface $entityManager, AdapterInterface $cache)
    {
        $this->hotelRepository = $entityManager->getRepository(Hotel::class);

        $this->reviewRepository = $entityManager->getRepository(Review::class);

        $this->cache = $cache;
    }

    /**
     * @param string $id
     * @return float
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getHotelScore(string $id): float
    {
        $item = $this->cache->getItem(self::CACHE_PREFIX . md5($id));
        if (!$item->isHit()) {
            $item->set($this->reviewRepository->getAverageScoreByHotelId($id));
            $item->expiresAfter(self::CACHE_TTL);
            $this->cache->save($item);
        }
        return $item->get();
    }

    /**
     * @param string|null $id
     * @return array
     */
    public function getReviews(?string $id = null): array
    {
        if ($id) {
            return $this->reviewRepository->getByHotelId($id);
        }

        return $this->reviewRepository->getAll();
    }

    /**
     * @return array
     */
    public function getHotels(): array
    {
        return $this->hotelRepository->getAll();
    }

    /**
     * @param string $groupId
     * @return null|HotelGroup
     */
    public function getHotelsByGroupId(string $groupId)
    {
        return $this->hotelRepository->getHotelsByGroupId($groupId);
    }
}
