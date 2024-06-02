<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employee>
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function findAllQuery(): Query {
        return $this->createQueryBuilder('e')
            ->andWhere('e.is_deleted IS NULL OR e.is_deleted = 0')
            ->orderBy('e.name', 'ASC')
            ->getQuery();
    }

    public function findByText($value): array {
        return $this->createQueryBuilder('e')
            ->where('c.name LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->orderBy('e.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Employee[] Returns an array of Employee objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Employee
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
