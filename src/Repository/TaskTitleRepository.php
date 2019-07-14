<?php

namespace App\Repository;

use App\Entity\TaskTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TaskTitle|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskTitle|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskTitle[]    findAll()
 * @method TaskTitle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskTitleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TaskTitle::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['name' => 'ASC']);
    }

    // /**
    //  * @return TaskTitle[] Returns an array of TaskTitle objects
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
    public function findOneBySomeField($value): ?TaskTitle
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
