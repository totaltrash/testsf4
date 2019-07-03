<?php

namespace App\Repository;

use App\Entity\ProjectTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectTitle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectTitle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectTitle[]    findAll()
 * @method ProjectTitle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTitleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectTitle::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['name' => 'ASC']);
    }

    // /**
    //  * @return ProjectTitle[] Returns an array of ProjectTitle objects
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
    public function findOneBySomeField($value): ?ProjectTitle
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
