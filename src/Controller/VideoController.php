<?php

namespace App\Controller;

use App\Interface\Controller\iController;
use App\Interface\UseCase\iVideoUseCase;
use App\Presentation\Helper\HttpResponse;
use App\Repository\CategoryRepository;
use App\Repository\VideoRepository;
use App\Trait\BaseController;
use App\UseCase\VideoUseCase;
use Exception;
use Kafkiansky\SymfonyMiddleware\Attribute\Middleware;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class VideoController extends AbstractController implements iController
{
    use BaseController;

    private iVideoUseCase $useCase;

    public function __construct(
        VideoRepository $videoRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->useCase = new VideoUseCase($videoRepository, $categoryRepository);
    }

    #[Middleware(['api'])]
    public function getByCategory(int $id): JsonResponse
    {
        try {
            $data = $this->useCase->findByCategory($id);

            return HttpResponse::ok($data);
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    public function freeVideos(): JsonResponse
    {
        try {
            $data = $this->useCase->freeVideos();

            return HttpResponse::ok($data);
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }
}
