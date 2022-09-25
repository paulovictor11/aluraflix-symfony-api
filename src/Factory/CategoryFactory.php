<?php

namespace App\Factory;

use App\Entity\Category;
use App\Interface\Factory\iCategoryFactory;
use App\Util\Error\MissingParamError;
use DateTimeImmutable;

class CategoryFactory implements iCategoryFactory
{
    /**
     * @param object $category
     * @return Category
     */
    public function createEntity(object $category): Category
    {
        $entity = new Category();
        $entity->title = $category->title;
        $entity->color = $category->color;
        $entity->createdAt = new DateTimeImmutable();

        return $entity;
    }

    /**
     * @param object $update
     * @param object $exist
     * @return Category
     */
    public function updateEntity(object $update, object $exist): Category
    {
        $entity = new Category();
        $entity->title = $update->title;
        $entity->color = $update->color;
        $entity->createdAt = $exist->createdAt;
        $entity->updatedAt = new DateTimeImmutable();

        return $entity;
    }

    /**
     * @param int $id
     * @return void
     * @throws MissingParamError
     */
    public function validateEntityId(int $id): void
    {
        if (empty($id)) {
            throw new MissingParamError('id');
        }
    }
}
