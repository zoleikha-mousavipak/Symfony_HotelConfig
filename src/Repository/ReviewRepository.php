<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    const TABLE_NAME = 'review';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    /**
     * @param string $id
     * @return float|null
     */
    public function getAverageScoreByHotelId(string $id): ?float
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('avg(review.score) as score')
            ->from(Review::class, 'review')
            ->where('IDENTITY(review.hotel) = :HotelId')
            ->setParameter('hotelId', $id);

        $result = $queryBuilder->getQuery()->getSingleScalarResult();

        return $result;
    }

    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder->select('review')
            ->from(Review::class, 'review');

        $result =  $queryBuilder->getQuery()->execute(null, Query::HYDRATE_ARRAY);

        return $result;
    }

    /**
     * @param string $id
     * @return array|null
     */
    public function getByHotelId($id): ?array
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('review')
            ->from(Review::class, 'review')
            ->where('IDENTITY(review.hotel) = :HotelId')
            ->setParameter('hotelId', $id);

        $result = $queryBuilder->getQuery()->execute(null, Query::HYDRATE_ARRAY);

        return $result;
    }
}
