<?php

namespace App\UseCase;

use App\Interface\Controller\iUserRepository;
use App\Interface\UseCase\iAuthUseCase;
use App\Presentation\Error\NotFoundError;
use App\Presentation\Error\UnauthorizedError;
use App\Util\Error\InvalidParamError;
use App\Util\Helper\EmailValidator;
use App\Util\Helper\Encrypter;
use App\Util\Helper\TokenGenerator;

class AuthUseCase implements iAuthUseCase
{
    public function __construct(private iUserRepository $userRepository)
    {
    }

    /**
     * @param string $requestData
     * @return array
     * @throws InvalidParamError
     * @throws NotFoundError
     * @throws UnauthorizedError
     */
    public function login(string $requestData): array
    {
        $data = json_decode($requestData);

        if (!EmailValidator::isValid($data->email)) {
            throw new InvalidParamError('email');
        }

        $user = $this->userRepository->findByEmail($data->email);
        if (is_null($user)) {
            throw new NotFoundError('user');
        }

        if (!Encrypter::compare($data->password, $user->password)) {
            throw new UnauthorizedError('Invalid password');
        }

        $token = TokenGenerator::generate($user->id);

        return [
            'token' => $token,
            'user'  => $user,
        ];
    }
}
