<?php

namespace App\Controller;

use App\Interface\Controller\iController;
use App\Interface\UseCase\iCategoryUseCase;
use App\Repository\CategoryRepository;
use App\Trait\BaseController;
use App\UseCase\CategoryUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController implements iController
{
    use BaseController;

    private iCategoryUseCase $useCase;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->useCase = new CategoryUseCase($categoryRepository);
    }
}
