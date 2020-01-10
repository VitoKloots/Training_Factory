<?php

namespace App\Repository;

use App\Entity\Gebruiker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gebruiker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gebruiker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gebruiker[]    findAll()
 * @method Gebruiker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GebruikerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gebruiker::class);
    }

    // /**
    //  * @return Gebruiker[] Returns an array of Gebruiker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gebruiker
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
