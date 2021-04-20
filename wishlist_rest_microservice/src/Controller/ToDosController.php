<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Linkin\Bundle\SwaggerResolverBundle\Factory\SwaggerResolverFactory;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ToDos;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ToDosController
 * @package App\Controller
 */
class ToDosController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private \Doctrine\Persistence\ObjectRepository $toDoRepository;

    /**
     * @var SwaggerResolverFactory
     */
    private SwaggerResolverFactory $swaggerResolverFactory;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;


    public function __construct(
        EntityManagerInterface $entityManager,
        SwaggerResolverFactory $swaggerResolverFactory,
        SerializerInterface $serializer
    )
    {
        $this->entityManager = $entityManager;
        $this->toDoRepository = $entityManager->getRepository(ToDos::class);
        $this->swaggerResolverFactory = $swaggerResolverFactory;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/todos/{id}", name="todos_get", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @SWG\Get(
     *     summary="Returns a specific todo or all of them.",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns status 200 and the todo.",
     *         @SWG\Schema(
     *             type="object",
     *             properties={
     *                 @SWG\Property(property="id", type="integer"),
     *                 @SWG\Property(property="name", type="string"),
     *                 @SWG\Property(property="description", type="string")
     *             }
     *         )
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Returns status 404 if there is no todo with the given id."
     *     )
     * )
     */
    public function getAction(int $id): JsonResponse
    {
//        if (!isset($id)) {
//        $toDo = $this->toDoRepository->findAll();
//        } else {
        $toDo = $this->toDoRepository->find($id);
//        }
        if (!$toDo) {
            throw new NotFoundHttpException();
        }

        return $this->createJsonResponse($toDo);
    }

    /**
     * @Route("/api/todos/{id}", name="todos_put", methods={"PUT"}, requirements={"id"="\d+"})
     *
     * @SWG\Put(
     *     summary="Updates an existing todo.",
     *     produces={"application/json"},
     *     @SWG\Parameter(name="id", in="path", required=true, type="integer"),
     *     @SWG\Parameter(
     *         name="body",
     *         description="Post data for Todos.",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *             required={"id", "name"},
     *             @SWG\Property(
     *                 property="name",
     *                 type="string",
     *                 minLength=1,
     *                 example="Max Hauptmann"
     *             ),
     *             @SWG\Property(
     *                 property="description",
     *                 type="string",
     *                 example="Krankenkasse anrufen"
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns status 200 and the modified todo.",
     *         @SWG\Schema(
     *             type="object",
     *             properties={
     *                 @SWG\Property(property="id", type="integer"),
     *                 @SWG\Property(property="name", type="string"),
     *                 @SWG\Property(property="description", type="string")
     *             }
     *         )
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Returns status 404 if there is no todo with the given id."
     *     )
     * )
     */
    public function putAction(Request $request, int $id): JsonResponse
    {
        $this->validateRequest($request);

        $toDo = $this->toDoRepository->find($id);
        if (!$toDo) {
            throw new NotFoundHttpException();
        }

        $this->updateObject($toDo, $request->getContent());
        $this->entityManager->flush();

        return $this->createJsonResponse($toDo);
    }

    /**
     * @Route("/api/todos/{id}", name="todos_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     * @SWG\Delete(
     *     summary="Deletes the given todo.",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns status 200 if the todo was deleted."
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Returns status 404 if there is no todo with the given id."
     *     )
     * )
     */
    public function deleteAction(int $id) :Response
    {
        $toDo = $this->toDoRepository->find($id);
        if (!$toDo) {
            throw new NotFoundHttpException();
        }

        $this->entityManager->remove($toDo);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @Route("/api/todos", name="todos_post", methods={"POST"})
     *
     * @SWG\Post(
     *     summary="Adds a new todo.",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         description="Post data.",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(
     *             type="object",
     *             required={"name"},
     *             @SWG\Property(
     *                 property="name",
     *                 type="string",
     *                 minLength=1,
     *                 example="Larissa Meier"
     *             ),
     *             @SWG\Property(
     *                 property="description",
     *                 type="string",
     *                 example="Hausaufgaben erledigen"
     *             ),
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Returns status 200 and the new todo.",
     *         @SWG\Schema(
     *             type="object",
     *             properties={
     *                 @SWG\Property(property="id", type="integer"),
     *                 @SWG\Property(property="name", type="string"),
     *                 @SWG\Property(property="description", type="string")
     *             }
     *         )
     *     )
     * )
     */
    public function postAction(Request $request): JsonResponse
    {
        $this->validateRequest($request);
        $toDo = $this->serializer->deserialize($request->getContent(), ToDos::class, 'json');

        $this->entityManager->persist($toDo);
        $this->entityManager->flush();

        return $this->createJsonResponse($toDo);
    }

    /**
     * @param object $target
     * @param string $jsonData
     */
    private function updateObject(object $target, string $jsonData)
    {
        $this->serializer->deserialize(
            $jsonData,
            get_class($target),
            'json',
            ['object_to_populate' => $target]
        );
    }

    /**
     * @param object $data
     * @return JsonResponse
     */
    private function createJsonResponse(object $data): JsonResponse
    {
        $jsonData = $this->serializer->serialize($data, 'json');

        return new JsonResponse($jsonData, Response::HTTP_OK, [], true);
    }

    /**
     * validation between request an annotations
     *
     * @param Request $request
     */
    protected function validateRequest(Request $request)
    {
        $swaggerResolver = $this->swaggerResolverFactory->createForRequest($request);
        $swaggerResolver->resolve(array_merge(
            json_decode($request->getContent(), true),
            $request->attributes->get('_route_params')
        ));
    }
}
