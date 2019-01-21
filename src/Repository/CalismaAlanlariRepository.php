<?php

namespace App\Repository;

use App\Entity\CalismaAlanlari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * @method CalismaAlanlari|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalismaAlanlari|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalismaAlanlari[]    findAll()
 * @method CalismaAlanlari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalismaAlanlariRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CalismaAlanlari::class);
    }

    // /**
    //  * @return CalismaAlanlari[] Returns an array of CalismaAlanlari objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CalismaAlanlari
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
