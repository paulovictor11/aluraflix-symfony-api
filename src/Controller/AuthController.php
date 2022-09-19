<?php

namespace App\Controller;

use App\Interface\UseCase\iAuthUseCase;
use App\Interface\UseCase\iUserUseCase;
use App\Presentation\Helper\HttpResponse;
use App\Repository\UserRepository;
use App\UseCase\AuthUseCase;
use App\UseCase\UserUseCase;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private iAuthUseCase $authUseCase;
    private iUserUseCase $userUseCase;

    public function __construct(UserRepository $userRepository)
    {
        $this->authUseCase = new AuthUseCase($userRepository);
        $this->userUseCase = new UserUseCase($userRepository);
    }

    #[Route(path: '/api/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        try {
            $data = $request->getContent();
            $response = $this->authUseCase->login($data);

            return HttpResponse::ok($response);
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }

    #[Route(path: '/api/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        try {
            $data = $request->getContent();
            $this->userUseCase->create($data);

            return HttpResponse::created();
        } catch (Exception $e) {
            return HttpResponse::badRequest($e->getMessage());
        }
    }
}
