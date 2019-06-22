<?php

namespace App\Repository;

use App\Entity\SurveyImage;
use App\Entity\SurveySubmission;
use App\Entity\SurveySubmissionImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveySubmissionImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveySubmissionImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveySubmissionImage[]    findAll()
 * @method SurveySubmissionImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveySubmissionImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveySubmissionImage::class);
    }

    /**
     * @param SurveyImage $image
     * @param SurveySubmission $submission
     * @return SurveySubmissionImage|null
     * @throws NonUniqueResultException
     */
    public function findByImageAndSubmission(SurveyImage $image, SurveySubmission $submission)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.image = :image and s.submission = :sub')
            ->setParameter('image', $image)
            ->setParameter('sub', $submission)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return SurveySubmissionImage[] Returns an array of SurveySubmissionImage objects
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
    public function findOneBySomeField($value): ?SurveySubmissionImage
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
