<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Owner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);

    }

    public function findByTypeAndNickName($type , $nickName)
    {
        $qb= $this->createQueryBuilder('animal')
            ->where('animal.type = :dog')
            ->andWhere('animal.nickName = :rex')
            ->setParameter('dog',$type)
            ->setParameter('rex',$nickName)
            ->orderBy('animal.nickName','ASC')
            ->getQuery()
            ->getResult();

        return $qb ;
    }

    public function findByOwnerFirstName($firstName)
    {
        $qb = $this->createQueryBuilder('animal')
            ->innerJoin('animal.owner' , 'owner')
            ->where('owner.firstName = :name_owner')
            ->setParameter('name_owner',$firstName)
            ->getQuery()
            ->getResult();

        return $qb ;
    }

    public function getQbAll()
    {
        $qb = $this->createQueryBuilder('animal');
        return $qb ;
    }

    public function getAnimalWithNoOwner()
    {
        $qb = $this->createQueryBuilder('a')
         ->where('a.owner IS NULL')
            ->getQuery()
            ->getResult();

        return $qb ;
    }

    public function animalsByOwner(Owner $ownerEntity)
    {

        $qb = $this->createQueryBuilder('a')
            -> innerJoin('a.owner' , 'o')
            ->where('o.id = :id')
            ->setParameter('id', $ownerEntity->getId())
            ->getQuery()
            ->getResult();

        return $qb ;

    }



}
