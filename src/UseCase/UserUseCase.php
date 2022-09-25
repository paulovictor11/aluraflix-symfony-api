<?php

namespace App\UseCase;

use App\Factory\UserFactory;
use App\Interface\Controller\iUserRepository;
use App\Interface\Factory\iUserFactory;
use App\Interface\UseCase\iUserUseCase;
use App\Util\Error\InvalidParamError;
use App\Util\Helper\EmailValidator;
use Exception;

class UserUseCase implements iUserUseCase
{
    private iUserFactory $userFactory;

    public function __construct(private readonly iUserRepository $repository)
    {
        $this->userFactory = new UserFactory();
    }

    /**
     * @param string $requestData
     * @return void
     * @throws InvalidParamError
     * @throws Exception
     */
    public function create(string $requestData): void
    {
        $data = json_decode($requestData);

        if (!EmailValidator::isValid($data->email)) {
            throw new InvalidParamError('email');
        }

        $this->checkIfUserAlreadyExists($data->email);

        $user = $this->userFactory->createEntity($data);

        $this->repository->add($user);
    }

    /**
     * @param string $email
     * @return void
     * @throws Exception
     */
    private function checkIfUserAlreadyExists(string $email): void
    {
        if (!is_null($this->repository->findByEmail($email))) {
            throw new Exception('User already exists');
        }
    }
}
