<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\SurveyImage;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends AbstractController {
    /**
     * @Route("/survey", name="create_survey", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();

        $survey = new Survey();
        $survey->setUuid(Uuid::uuid4()->toString());
        $survey->setTitle($request->request->get('title'));
        $survey->setDescription($request->request->get('description'));

        $entityManager->persist($survey);
        $entityManager->flush();

        return $this->json($survey);
    }

    /**
     * @Route("/survey/{uuid}", name="get_survey", methods={"GET"})
     *
     * @param $uuid
     * @return JsonResponse
     */
    public function getSurvey($uuid) {
        $repository = $this->getDoctrine()->getRepository(Survey::class);
        try {
            $survey = $repository->findByUuid($uuid);
            return $this->json($survey);
        } catch (NoResultException $e) {
            return $this->json(['message' => 'Not found'], 404);
        } catch (NonUniqueResultException $e) {
            return $this->json(['message' => 'Internal server error, duplicate uuid'], 500);
        }
    }

    /**
     * @Route("/survey/{uuid}/images", name="create_image", methods={"POST"})
     *
     * @param $uuid
     * @param Request $request
     * @param LoggerInterface $logger
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function addImage($uuid, Request $request, LoggerInterface $logger) {
        $survey = $this->getDoctrine()->getRepository(Survey::class)->findByUuid($uuid);

        $surveyImage = new SurveyImage();
        $surveyImage->setUuid(Uuid::uuid4()->toString());
        $surveyImage->setImage($request->files->get('image'));
        $surveyImage->setFake($request->request->get('fake'));

        $survey->addImage($surveyImage);

        $logger->info('creating image!');

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($surveyImage);

        $manager->flush();

        return $this->json($surveyImage);
    }
}
