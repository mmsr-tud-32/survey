<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveyImage;
use App\Entity\SurveySubmission;
use App\Entity\SurveySubmissionImage;
use App\Entity\SurveySubmissionLongImage;
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

            if ($survey->getImages()->count() < ($survey->getNumPractise() + $survey->getNumQuestionShort())) {
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
            $questionShortImages = array_slice($images, $survey->getNumPractise(), $survey->getNumQuestionShort());
            $questionLongImages = array_slice($images, $survey->getNumPractise() + $survey->getNumQuestionShort(), $survey->getNumQuestionLong());

            array_map(function ($image) use ($submission, $manager) {
                $submissionImage = new SurveySubmissionPractiseImage();
                $submissionImage->setImage($image);
                $submissionImage->setSubmission($submission);
                $submission->addPractiseImage($submissionImage);

                $manager->persist($submissionImage);
            }, $practiseImages);

            array_map(function ($image) use ($submission, $manager) {
                $submissionImage = new SurveySubmissionImage();
                $submissionImage->setImage($image);
                $submissionImage->setSubmission($submission);
                $submission->addImage($submissionImage);

                $manager->persist($submissionImage);
            }, $questionShortImages);

            array_map(function ($image) use ($submission, $manager) {
                $submissionImage = new SurveySubmissionLongImage();
                $submissionImage->setImage($image);
                $submissionImage->setSubmission($submission);
                $submission->addSurveySubmissionLongImage($submissionImage);

                $manager->persist($submissionImage);
            }, $questionLongImages);

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
     * @throws NonUniqueResultException
     */
    public function getSubmission($uuid) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        return $this->json($surveySubmission);
    }

    /**
     * @Route("/submission/{uuid}/answer_practise", name="answer_practise", methods={"POST"})
     *
     * @param $uuid
     * @param Request $request
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function answerPractise($uuid, Request $request) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        $surveyImage = $this->getDoctrine()
            ->getRepository(SurveyImage::class)
            ->findByUuid($request->request->get('image_uuid'));

        $surveySubmissionImage = $this->getDoctrine()
            ->getRepository(SurveySubmissionPractiseImage::class)
            ->findByImageAndSubmission($surveyImage, $surveySubmission);

        if ($surveySubmissionImage == null) {
            return $this->json('', 404);
        }

        $surveySubmissionImage->setFake($request->request->getBoolean('fake'));

        $this->getDoctrine()->getManager()->flush();

        return $this->json($surveySubmissionImage);
    }

    /**
     * @Route("/submission/{uuid}/answer_short", name="answer_short", methods={"POST"})
     *
     * @param $uuid
     * @param Request $request
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function answerShort($uuid, Request $request) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        $surveyImage = $this->getDoctrine()
            ->getRepository(SurveyImage::class)
            ->findByUuid($request->request->get('image_uuid'));

        $surveySubmissionImage = $this->getDoctrine()
            ->getRepository(SurveySubmissionImage::class)
            ->findByImageAndSubmission($surveyImage, $surveySubmission);

        if ($surveySubmissionImage == null) {
            return $this->json('', 404);
        }

        $surveySubmissionImage->setFake($request->request->getBoolean('fake'));

        $this->getDoctrine()->getManager()->flush();

        return $this->json($surveySubmissionImage);
    }

    /**
     * @Route("/submission/{uuid}/answer_long", name="answer_long", methods={"POST"})
     *
     * @param $uuid
     * @param Request $request
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function answerLong($uuid, Request $request) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        $surveyImage = $this->getDoctrine()
            ->getRepository(SurveyImage::class)
            ->findByUuid($request->request->get('image_uuid'));

        $surveySubmissionImage = $this->getDoctrine()
            ->getRepository(SurveySubmissionLongImage::class)
            ->findByImageAndSubmission($surveyImage, $surveySubmission);

        if ($surveySubmissionImage == null) {
            return $this->json('', 404);
        }

        $surveySubmissionImage->setFake($request->request->getBoolean('fake'));

        $this->getDoctrine()->getManager()->flush();

        return $this->json($surveySubmissionImage);
    }

    /**
     * @Route("/submission/{uuid}/submit", name="submit_survey", methods={"POST"})
     *
     * @param $uuid
     * @return JsonResponse
     * @throws NonUniqueResultException
     */
    public function submitSurvey($uuid) {
        $surveySubmission = $this->getDoctrine()
            ->getRepository(SurveySubmission::class)
            ->findByUuid($uuid);

        $shortImages = $surveySubmission->getImages();

        foreach ($shortImages as $shortImage) {
            if ($shortImage->getFake() === null) {
                return $this->json(['message' => vsprintf('Short image %s has no answer', [$shortImage->getImage()->getUuid()])], 400);
            }
        }

        $longImages = $surveySubmission->getLongImages();

        foreach ($longImages as $longImage) {
            if ($longImage->getFake() === null) {
                return $this->json(['message' => vsprintf('Long image %s has no answer', [$longImage->getImage()->getUuid()])], 400);
            }
        }

        $practiseImages = $surveySubmission->getPractiseImages();

        foreach ($practiseImages as $practiseImage) {
            if ($practiseImage->getFake() === null) {
                return $this->json(['message' => vsprintf('Practise image %s has no answer', [$practiseImage->getImage()->getUuid()])], 400);
            }
        }

        $surveySubmission->setSubmitted(true);

        $this->getDoctrine()->getManager()->flush();

        return $this->json('', 200);
    }
}
