<?php

namespace App\Factory;

use App\Entity\Category;
use App\Interface\Factory\iCategoryFactory;
use App\Util\Error\InvalidParamError;
use DateTimeImmutable;
use MissingParamError;

class CategoryFactory implements iCategoryFactory
{
    /**
     * @param Category $category
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
     * @param Category $update
     * @param Category $exist
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
        if (is_null($id)) {
            throw new MissingParamError('id');
        }
    }

    /**
     * @param Category $category
     * @return void
     * @throws MissingParamError|InvalidParamError
     */
    public function validateEntityParams(object $category): void
    {
        $properties = ['title', 'color'];

        foreach ($properties as $key) {
            if (!property_exists($category, $key)) {
                throw new MissingParamError($key);
            }

            if (empty($category->$key)) {
                throw new InvalidParamError($key);
            }
        }
    }
}
