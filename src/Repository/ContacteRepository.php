<?php

namespace App\Repository;

use App\Entity\Contacte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contacte>
 */
class ContacteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contacte::class);
    }

    public function findByName($text): array
{
    $qb = $this->createQueryBuilder('c')
        ->andWhere('c.nom LIKE :text')
        ->setParameter('text', '%' . $text . '%')
        ->getQuery();

    return $qb->execute();
}

    //    /**
    //     * @return Contacte[] Returns an array of Contacte objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contacte
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
