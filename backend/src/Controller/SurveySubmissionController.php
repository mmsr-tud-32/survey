<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveySubmission;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SurveySubmissionController extends AbstractController
{
    /**
     * @Route("/submission", name="submission_create", methods={"POST"})
     * @param string $surveyUuid
     * @param string $name
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function createSubmission(string $surveyUuid, string $name) {
        try {

        $survey = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->findByUuid($surveyUuid);

        $submission = new SurveySubmission();

        $submission->setSurvey($survey);
        $submission->setName($name);

        // TODO create submission images

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($submission);
        $manager->flush();

        return $this->json($submission);
        } catch (NoResultException $e) {
            return $this->json([
                'message' => vsprintf('Survey with uuid "%s" not found.', [$surveyUuid]),
            ], 400);
        }
    }
}
