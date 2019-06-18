<?php

namespace App\Repository;

use App\Entity\SurveyImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveyImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyImage[]    findAll()
 * @method SurveyImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveyImage::class);
    }

    // /**
    //  * @return SurveyImage[] Returns an array of SurveyImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SurveyImage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
