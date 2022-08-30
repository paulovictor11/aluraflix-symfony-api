<?php

namespace App\Interface\Factory;

use App\Entity\Category;

interface iCategoryFactory
{
    public function createEntity(object $category): Category;
    public function updateEntity(object $update, object $exist): Category;
    public function validateEntityId(int $id): void;
    public function validateEntityParams(object $category): void;
}
