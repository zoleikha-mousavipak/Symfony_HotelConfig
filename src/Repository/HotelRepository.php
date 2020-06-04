<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hotel::class);
    }

    public function getAll()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder->select('hotel')
            ->from(Hotel::class, 'hotel');

        $result = $queryBuilder->getQuery()->execute(null, Query::HYDRATE_ARRAY);

        return $result;
    }

    public function getHotelsByGroupId(string $groupId)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder->select('hotel')
            ->from(Hotel::class, 'hotel')
            ->where('IDENTITY((hotel.group) = :groupId')
            ->setParameter('groupId', $groupId);

        $queryBuilder->getQuery()->execute(null, Query::HYDRATE_ARRAY);
    }
}
