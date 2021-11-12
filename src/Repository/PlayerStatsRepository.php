<?php

namespace App\Repository;

use App\Entity\PlayerStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlayerStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerStats[]    findAll()
 * @method PlayerStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerStats::class);
    }

    // /**
    //  * @return PlayerStats[] Returns an array of Stats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayerStats
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllYoungerStats($min, $max): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\PlayerStats p
            WHERE p.age between :mini and :maxi'
        )->setParameter('mini', $min)
        ->setParameter('maxi', $max);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findNationsCount(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT count(p), p.nation
            FROM App\Entity\PlayerStats p
            GROUP BY p.nation 
            ORDER BY count(p) DESC
            '
        );
        $query->setMaxResults(20);

        // returns an array of Product objects
        return $query->getResult();
    }
}
