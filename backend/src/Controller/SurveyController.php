<?php

namespace App\Controller;

use App\Entity\Survey;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $survey->setTitle($request->request->get("title"));

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
}
