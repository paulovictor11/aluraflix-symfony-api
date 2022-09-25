<?php

namespace App\Factory;

use App\Entity\User;
use App\Interface\Factory\iUserFactory;
use App\Util\Error\MissingParamError;
use App\Util\Helper\Encrypter;
use DateTimeImmutable;

class UserFactory implements iUserFactory
{
    /**
     * @param object $user
     * @return User
     * @throws MissingParamError
     */
    public function createEntity(object $user): User
    {
        $hashedPassword = Encrypter::encrypt($user->password);

        $entity = new User();
        $entity->name = $user->name;
        $entity->email = $user->email;
        $entity->password = $hashedPassword;
        $entity->createdAt = new DateTimeImmutable();

        return $entity;
    }

    /**
     * @param object $update
     * @param object $exist
     * @return User
     */
    public function updateEntity(object $update, object $exist): User
    {
        $user = new User();
        $user->name = $update->name;
        $user->email = $update->email;
        $user->password = $exist->password;
        $user->createdAt = $exist->createdAt;
        $user->updatedAt = new DateTimeImmutable();

        return $user;
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
