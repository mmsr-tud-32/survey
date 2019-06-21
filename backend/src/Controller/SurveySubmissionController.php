<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveySubmission;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SurveySubmissionController extends BaseController {
    /**
     * @Route("/submission", name="submission_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws NonUniqueResultException
     * @throws Exception
     */
    public function createSubmission(Request $request) {
        $surveyUuid = $request->request->get('survey_uuid');
        $name = $request->request->get('name');

        try {
            $survey = $this->getDoctrine()
                ->getRepository(Survey::class)
                ->findByUuid($surveyUuid);

            $submission = new SurveySubmission();

            $submission->setUuid(Uuid::uuid4()->toString());
            $submission->setSubmitted(false);
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
