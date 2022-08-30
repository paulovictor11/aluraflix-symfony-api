<?php

namespace App\Controller;

use App\Interface\Controller\iController;
use App\Interface\UseCase\iVideoUseCase;
use App\Presentation\Helper\HttpResponse;
use App\Repository\VideoRepository;
use App\UseCase\VideoUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController implements iController
{
    private iVideoUseCase $videoUseCase;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoUseCase = new VideoUseCase($videoRepository);
    }

    #[Route('/api/videos', name: 'all_videos', methods: ['GET'])]
    public function listAll(): JsonResponse
    {
        try {
            /** @var Video[] $entities */
            $entities = $this->videoUseCase->listAll();

            return HttpResponse::ok($entities);
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route('/api/videos', name: 'create_video', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->videoUseCase->create($data);

            return HttpResponse::created();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route('/api/video/{id}', name: 'get_video', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        try {
            $entity = $this->videoUseCase->show($id);

            return HttpResponse::ok($entity);
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route('/api/video/{id}', name: 'update_video', methods: ['PUT', 'PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->videoUseCase->update($data, $id);

            return HttpResponse::ok();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route('/api/video/{id}', name: 'delete_video', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        try {
            $this->videoUseCase->delete($id);

            return HttpResponse::ok();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }
}
