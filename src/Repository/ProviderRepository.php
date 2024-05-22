<?php

namespace App\Repository;

use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Provider>
 *
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    public function findByTextQuery(string $value): Query {
        return $this->createQueryBuilder('p')
            ->andWhere('p.email LIKE :val')
            ->orWhere('p.name LIKE :val')
            ->orWhere('p.dni LIKE :val')
            ->orWhere('p.cif LIKE :val')
            ->orWhere('p.phone LIKE :val')
            ->setParameter('val', "%$value%")
            ->orderBy('p.email', 'ASC')
            ->setMaxResults(10)
            ->getQuery();
    }

    public function findAllQuery(): Query {
        return $this->createQueryBuilder('p')
            ->where('p.is_deleted =  false')
            ->orderBy('p.id', 'ASC')
            ->getQuery();
    }

    //    /**
    //     * @return Provider[] Returns an array of Provider objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Provider
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}