<?php

namespace App\Controller;

use App\Entity\Knight;
use App\Repository\KnightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class APIController extends AbstractController
{
    /**
     * @Rest\Get(
     *      path="/knights",
     *      name="knights",
     * )
     * @return JsonResponse|Response
     */
    public function getKnights(KnightRepository $knightsRepo)
    {
        $knights = $knightsRepo->findAll();

        if (count($knights) > 0) {
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);
    
            $jsonContent = $serializer->serialize($knights, 'json', [
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }
            ]);
            
            $response = new Response($jsonContent);
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            return new JsonResponse('NOT FOUND', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post(
     *      path="/knight",
     *      name="knight",
     * )
     * @return JsonResponse|Response
     */
    public function setKnight(KnightRepository $knightsRepo, Request $request)
    {
        $knights = $knightsRepo->findAll();

        if (count($knights) >= 2) {
            return new JsonResponse('BAD REQUEST', Response::HTTP_BAD_REQUEST);
        } else {
            $knight = new Knight();
            $data = json_decode($request->getContent());
            // var_dump($data); exit;

            $knight->setName($data->name);
            $knight->setStrength($data->strength);
            $knight->setWeaponPower($data->weaponPower);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($knight);
            $entityManager->flush();

            // return new Response('OK', 201);
            return new JsonResponse('OK', Response::HTTP_OK);
        }
    }

    /**
     * @Rest\Get(
     *      path="/knight/{id}",
     *      name="knight",
     * )
     * @return JsonResponse|Response
     */
    public function getKnight(KnightRepository $knightsRepo, Request $request)
    {
        if ($request->get('id') && \is_numeric($request->get('id'))) {
            $knight = $knightsRepo->find($request->get('id'));

            if ($knight) {
                $encoders = [new JsonEncoder()];
                $normalizers = [new ObjectNormalizer()];
                $serializer = new Serializer($normalizers, $encoders);
                $jsonContent = $serializer->serialize($knight, 'json', [
                    'circular_reference_handler' => function ($object) {
                        return $object->getId();
                    }
                ]);
                $response = new Response($jsonContent);
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            } else {
                return new JsonResponse('NOT FOUND', Response::HTTP_NOT_FOUND);
            }
        } else {
            return new JsonResponse('BAD REQUEST', Response::HTTP_BAD_REQUEST);
        }
    }
}
