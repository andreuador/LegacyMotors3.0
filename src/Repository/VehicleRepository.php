<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    public function findAllQuery(): Query {
        return $this->createQueryBuilder('v')
            ->andWhere('v.is_deleted IS NULL OR v.is_deleted = 0')
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ;
    }

    public function findByTextQuery(string $value): Query {
        return $this->createQueryBuilder('v')
            ->join('v.brand', 'b')
            ->join('m.model', 'm')
            ->where('b.name LIKE :value')
            ->orWhere('m.name LIKE :value')
            ->orWhere('v.color LIKE :value')
            ->orWhere('v.transmission LIKE :value')
            ->orWhere('v.fuel LIKE :value')
            ->orWhere('v.year LIKE :value')
            ->orWhere('v.price LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->setParameter('v.id', 'ASC')
            ->getQuery();
    }

    //    /**
    //     * @return Vehicle[] Returns an array of Vehicle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vehicle
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
