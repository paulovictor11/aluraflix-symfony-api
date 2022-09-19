<?php

namespace App\UseCase;

use App\Factory\UserFactory;
use App\Interface\Controller\iUserRepository;
use App\Interface\Factory\iUserFactory;
use App\Interface\UseCase\iUserUseCase;
use Exception;

class UserUseCase implements iUserUseCase
{
    private iUserFactory $userFactory;

    public function __construct(private iUserRepository $userRepository)
    {
        $this->userFactory = new UserFactory();
    }

    public function create(string $requestData): void
    {
        $data = json_decode($requestData);


        $this->userFactory->validateEntityParams($data);
        $this->checkIfUserAlreadyExists($data->email);

        $user = $this->userFactory->createEntity($data);

        $this->userRepository->add($user);
    }

    /**
     * @param string $email
     * @return void
     * @throws Exception
     */
    private function checkIfUserAlreadyExists(string $email)
    {
        if (!is_null($this->userRepository->findByEmail($email))) {
            throw new Exception('User already exists');
        }
    }
}
