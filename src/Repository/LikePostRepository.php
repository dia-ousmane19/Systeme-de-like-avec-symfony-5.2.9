<?php

namespace App\Repository;

use App\Entity\LikePost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LikePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikePost[]    findAll()
 * @method LikePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikePostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikePost::class);
    }

    // /**
    //  * @return LikePost[] Returns an array of LikePost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikePost
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
