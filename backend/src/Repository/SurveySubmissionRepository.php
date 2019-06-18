<?php

namespace App\Repository;

use App\Entity\SurveySubmission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveySubmission|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveySubmission|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveySubmission[]    findAll()
 * @method SurveySubmission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveySubmissionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveySubmission::class);
    }

    // /**
    //  * @return SurveySubmission[] Returns an array of SurveySubmission objects
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
    public function findOneBySomeField($value): ?SurveySubmission
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
