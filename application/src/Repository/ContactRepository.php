<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[] Returns an array of Contact objects
     */
    public function findLast()
    {
        return $this->createQueryBuilder('c')
            ->select("c.fullName, c.type, c.role")
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
      * @return int Returns the number of contacts
      */
    public function countAll()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return Contact[] Returns an array of Contact objects
     * 
     * @param string $column
     * @param string $order
     */
    public function findSorted($column, $order)
    {
        return $this->createQueryBuilder('c')
            ->orderBy("c.$column", $order)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Contact[] Returns an array of Contact objects
     * 
     * @param string $name
     */
    public function findByName($name)
    {
        return $this->createQueryBuilder('c')
            ->where("c.fullName LIKE :name")
            ->setParameter("name", "%$name%")
            ->getQuery()
            ->getResult()
        ;
    }
}
