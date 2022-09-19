<?php

namespace App\Controller;

use App\Entity\Category;
use App\Interface\Controller\iController;
use App\Interface\UseCase\iCategoryUseCase;
use App\Presentation\Helper\HttpResponse;
use App\Repository\CategoryRepository;
use App\UseCase\CategoryUseCase;
use App\Util\Helper\DataExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController implements iController
{
    private iCategoryUseCase $categoryUseCase;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryUseCase = new CategoryUseCase($categoryRepository);
    }

    #[Route(path: '/api/categories', name: 'all_categories', methods: ['GET'])]
    public function all(Request $request): JsonResponse
    {
        try {
            $filter = DataExtractor::filterData($request);
            $sort = DataExtractor::sortData($request);
            [$page, $perPage] = DataExtractor::paginationData($request);

            /** @var Category[] $entities */
            $entities = $this->categoryUseCase->all($filter, $sort, $page, $perPage);

            return HttpResponse::ok($entities);
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route(path: '/api/categories', name: 'create_category', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->categoryUseCase->create($data);

            return HttpResponse::created();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route(path: '/api/category/{id}', name: 'get_category', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        try {
            $entity = $this->categoryUseCase->show($id);

            return HttpResponse::ok($entity);
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route(path: '/api/category/{id}', name: 'update_category', methods: ['PUT', 'PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->categoryUseCase->update($data, $id);

            return HttpResponse::ok();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route(path: '/api/category/{id}', name: 'delete_category', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        try {
            $this->categoryUseCase->delete($id);

            return HttpResponse::ok();
        } catch (\Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }
}
