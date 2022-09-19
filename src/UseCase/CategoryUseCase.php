<?php

namespace App\UseCase;

use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Interface\Controller\iCategoryRepository;
use App\Interface\Factory\iCategoryFactory;
use App\Interface\UseCase\iCategoryUseCase;
use App\Presentation\Error\NotFoundError;

class CategoryUseCase implements iCategoryUseCase
{
    private iCategoryFactory $categoryFactory;

    public function __construct(private iCategoryRepository $categoryRepository)
    {
        $this->categoryFactory = new CategoryFactory();
    }

    /**
     * @return Category[]
     */
    public function all(array $filter, array $sort, int $page, int $perPage): array
    {
        return $this->categoryRepository->all(
            $filter,
            $sort,
            $page,
            $perPage
        );
    }

    /**
     * @param string $requestData
     * @return void
     */
    public function create(string $requestData): void
    {
        $data = json_decode($requestData);

        $this->categoryFactory->validateEntityParams($data);

        $entity = $this->categoryFactory->createEntity($data);

        $this->categoryRepository->add($entity);

        return;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function show(int $id): Category
    {
        $this->categoryFactory->validateEntityId($id);

        $entity = $this->checkifEntityExists($id);

        return $entity;
    }

    /**
     * @param string $requestData
     * @param int $id
     * @return void
     */
    public function update(string $requestData, int $id): void
    {
        $data = json_decode($requestData);

        $this->categoryFactory->validateEntityId($id);

        $existEntity = $this->checkifEntityExists($id);
        $entity = $this->categoryFactory->updateEntity($data, $existEntity);

        $this->categoryRepository->update($entity, $id);

        return;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->categoryFactory->validateEntityId($id);
        $this->checkifEntityExists($id);
        $this->categoryRepository->delete($id);

        return;
    }

    /**
     * @param int $id
     * @return Category
     * @throws NotFoundError
     */
    private function checkifEntityExists(int $id): Category
    {
        $doesEntityExists = $this->categoryRepository->show($id);
        if (is_null($doesEntityExists)) {
            throw new NotFoundError('category');
        }

        return $doesEntityExists;
    }
}
