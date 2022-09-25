<?php

namespace App\Trait;

use App\Presentation\Helper\HttpResponse;
use App\Util\Helper\DataExtractor;
use Exception;
use Kafkiansky\SymfonyMiddleware\Attribute\Middleware;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

trait BaseController
{
    #[Middleware(['api'])]
    public function all(Request $request): JsonResponse
    {
        try {
            if ($search = $request->query->get('search')) {
                $entities = $this->useCase->findByName($search);

                return HttpResponse::ok($entities);
            }

            $filter = DataExtractor::filterData($request);
            $sort = DataExtractor::sortData($request);
            [$page, $perPage] = DataExtractor::paginationData($request);

            $entities = $this->useCase->all($filter, $sort, $page, $perPage);

            return HttpResponse::ok($entities);
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Middleware(['api'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->useCase->create($data);

            return HttpResponse::created();
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Middleware(['api'])]
    public function show(int $id): JsonResponse
    {
        try {
            $entity = $this->useCase->show($id);

            return HttpResponse::ok($entity);
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Middleware(['api'])]
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->useCase->update($data, $id);

            return HttpResponse::ok();
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Middleware(['api'])]
    public function delete(int $id): JsonResponse
    {
        try {
            $this->useCase->delete($id);

            return HttpResponse::ok();
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }
}
