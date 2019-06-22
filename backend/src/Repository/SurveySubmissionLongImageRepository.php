<?php

namespace App\Repository;

use App\Entity\SurveyImage;
use App\Entity\SurveySubmission;
use App\Entity\SurveySubmissionLongImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SurveySubmissionLongImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveySubmissionLongImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveySubmissionLongImage[]    findAll()
 * @method SurveySubmissionLongImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveySubmissionLongImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SurveySubmissionLongImage::class);
    }

    /**
     * @param SurveyImage $image
     * @param SurveySubmission $submission
     * @return SurveySubmissionLongImage|null
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
    //  * @return SurveySubmissionLongImage[] Returns an array of SurveySubmissionLongImage objects
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
    public function findOneBySomeField($value): ?SurveySubmissionLongImage
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
