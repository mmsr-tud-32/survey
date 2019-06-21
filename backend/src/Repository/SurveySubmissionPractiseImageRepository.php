<?php

namespace App\Repository;

use App\Entity\SurveySubmissionPractiseImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveySubmissionPractiseImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveySubmissionPractiseImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveySubmissionPractiseImage[]    findAll()
 * @method SurveySubmissionPractiseImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveySubmissionPractiseImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveySubmissionPractiseImage::class);
    }

    // /**
    //  * @return SurveySubmissionPractiseImage[] Returns an array of SurveySubmissionPractiseImage objects
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
    public function findOneBySomeField($value): ?SurveySubmissionPractiseImage
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
