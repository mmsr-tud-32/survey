<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveySubmission;
use App\Entity\SurveySubmissionImage;
use App\Entity\SurveySubmissionPractiseImage;
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
            $manager = $this->getDoctrine()->getManager();

            if ($survey->getImages()->count() < ($survey->getNumPractise() + $survey->getNumQuestion())) {
                return $this->json([
                    'message' => 'Not enough items in survey',
                ], 400);
            }

            $submission = new SurveySubmission();

            $submission->setUuid(Uuid::uuid4()->toString());
            $submission->setSubmitted(false);
            $submission->setSurvey($survey);
            $submission->setName($name);

            $images = $survey->getImages()->getValues();

            shuffle($images);

            $practiseImages = array_slice($images, 0, $survey->getNumPractise());
            $questionImages = array_slice($images, $survey->getNumPractise(), $survey->getNumQuestion());

            array_map(function ($image) use ($submission, $manager) {
                $submissionImage = new SurveySubmissionPractiseImage();
                $submissionImage->setImage($image);
                $submissionImage->setSubmission($submission);
                $manager->persist($submissionImage);

                $submission->addPractiseImage($submissionImage);
            }, $practiseImages);

            array_map(function ($image) use ($submission, $manager) {
                $submissionImage = new SurveySubmissionImage();
                $submissionImage->setImage($image);
                $submissionImage->setSubmission($submission);
                $manager->persist($submissionImage);

                $submission->addImage($submissionImage);
            }, $questionImages);

            $manager->persist($submission);
            $manager->flush();

            return $this->json($submission);
        } catch (NoResultException $e) {
            return $this->json([
                'message' => vsprintf('Survey with uuid "%s" not found.', [$surveyUuid]),
            ], 400);
        }
    }

    /**
     * @Route("/submission/{uuid}", name="get_submission", methods={"GET"})
     *
     * @param $uuid
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getSubmission($uuid) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        return $this->json($surveySubmission);
    }
}
