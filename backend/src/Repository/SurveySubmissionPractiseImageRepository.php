<?php

namespace App\Repository;

use App\Entity\SurveyImage;
use App\Entity\SurveySubmission;
use App\Entity\SurveySubmissionPractiseImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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

    /**
     * @param SurveyImage $image
     * @param SurveySubmission $submission
     * @return SurveySubmissionPractiseImage|null
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
