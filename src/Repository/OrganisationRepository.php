<?php

namespace App\Repository;

use App\Entity\Organisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Organisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organisation[]    findAll()
 * @method Organisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganisationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Organisation::class);
    }

    public function findActive()
    {
        return $this->findBy(['active' => true], ['name' => 'ASC']);
    }

    public function findActiveQueryBuilder()
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.active = true')
            ->orderBy('o.name', 'ASC')
        ;
    }
}
