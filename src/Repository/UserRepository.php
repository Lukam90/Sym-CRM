<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Returns the number of users
     * 
      * @return int
      */
    public function countAll()
    {
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * Returns an array of User objects
     * 
     * @return User[]
     */
    public function findSorted($column, $order = 'ASC')
    {
        return $this->createQueryBuilder('u')
            ->orderBy("u.$column", $order)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Returns an array of User objects 
     * 
     * @return User[]
     * 
     * @param string $name
     */
    public function findByName($name)
    {
        return $this->createQueryBuilder('u')
            ->where("u.fullName LIKE :name")
            ->setParameter("name", "%$name%")
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Returns a user with an email address
     * 
     * @param string $email
     * 
     * @return User
     */
    public function findByEmail($email)
    {
        return $this->createQueryBuilder('u')
            ->where("u.email LIKE :email")
            ->setParameter("email", "%$email%")
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }
}
