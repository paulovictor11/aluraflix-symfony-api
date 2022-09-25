<?php

namespace App\Interface\Factory;

interface iAbstractFactory
{
    public function createEntity(object $entity): object;
    public function updateEntity(object $update, object $exist): object;
    public function validateEntityId(int $id): void;
}
