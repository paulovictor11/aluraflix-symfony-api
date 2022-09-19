<?php

namespace App\Factory;

use App\Entity\User;
use App\Interface\Factory\iUserFactory;
use App\Util\Error\InvalidParamError;
use App\Util\Helper\EmailValidator;
use App\Util\Helper\Encrypter;
use DateTimeImmutable;
use MissingParamError;

class UserFactory implements iUserFactory
{
    /**
     * @param User $user
     * @param bool $updateAt
     * 
     * @return User
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
     * @param User $updateUser
     * @param User $existingUser
     * 
     * @return User
     */
    public function updateEntity(object $updateUser, object $existingUser): User
    {
        $user = new User();
        $user->name = $updateUser->name;
        $user->email = $updateUser->email;
        $user->password = $existingUser->password;
        $user->createdAt = $existingUser->createdAt;
        $user->updatedAt = new DateTimeImmutable();

        return $user;
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function validateEntityId(int $id): void
    {
        if (is_null($id)) {
            throw new MissingParamError('id');
        }
    }

    /**
     * @param User $user
     * 
     * @return void
     */
    public function validateEntityParams(object $user): void
    {
        $properties = ['name', 'email', 'password'];

        foreach ($properties as $key) {
            if (!property_exists($user, $key)) {
                throw new MissingParamError($key);
            }

            if (empty($user->$key)) {
                throw new InvalidParamError($key);
            }

            if ($key == 'email' && !EmailValidator::isValid($user->email)) {
                throw new InvalidParamError('email');
            }
        }
    }
}
