<?php

namespace App\Repository;

use App\Entity\Category;
use App\Interface\Controller\iCategoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements iCategoryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[]
     */
    public function all(array $filter, array $sort, int $page, int $perPage): array
    {
        return $this->findBy(
            $filter,
            $sort,
            $perPage,
            ($page - 1) * $perPage
        );
    }

    /**
     * @param Category $category
     * @return void
     */
    public function add(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();

        return;
    }

    /**
     * @param int $id
     * @return ?Category
     */
    public function show(int $id): ?Category
    {
        $entity = $this->findOneById($id);
        if (is_null($entity)) {
            return null;
        }

        return $entity;
    }

    /**
     * @param Category $category
     * @param int $id
     * @return void
     */
    public function update(Category $category, int $id): void
    {
        /** @var Category $entity */
        $entity = $this->getEntityManager()->getReference(Category::class, $id);

        $entity->title = $category->title;
        $entity->color = $category->color;
        $entity->updatedAt = $category->updatedAt;

        $this->getEntityManager()->flush();

        return;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $entity = $this->getEntityManager()->getReference(Category::class, $id);

        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return;
    }
}
