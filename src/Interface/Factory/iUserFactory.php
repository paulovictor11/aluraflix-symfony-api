<?php

namespace App\Interface\Factory;

use App\Entity\User;

interface iUserFactory
{
    public function createEntity(object $user): User;
    public function updateEntity(object $update, object $exist): User;
    public function validateEntityId(int $id): void;
    public function validateEntityParams(object $user): void;
}
