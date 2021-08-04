<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function getPostsBetweenTwoDates($date_inf , $date_sup)
    {
        $qb= $this->createQueryBuilder('post')
            ->where('post.createdAt < :ds')
            ->andWhere('post.createdAt > :di')
            ->setParameter('di',$date_inf)
            ->setParameter('ds',$date_sup)
            ->getQuery()
            ->getResult();

        return $qb ;
    }

    public function getAllPosts()
    {
        $qb= $this->createQueryBuilder('post')
            ->orderBy('post.createdAt','ASC')
            ->getQuery()
            ->getResult();

        return $qb ;
    }



}
