<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    /**
      * @return int Returns the number of teams
      */
    public function countAll()
    {
        return $this->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return Team[] Returns an array of Team objects
     */
    public function findSorted($column, $order = 'ASC')
    {
        return $this->createQueryBuilder('t')
            ->orderBy("t.$column", $order)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Team[] Returns an array of Team objects
     * 
     * @param string $name
     */
    public function findByName($name)
    {
        return $this->createQueryBuilder('t')
            ->where("t.name LIKE :name")
            ->setParameter("name", "%$name%")
            ->getQuery()
            ->getResult()
        ;
    }
}
