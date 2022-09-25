<?php

namespace App\UseCase;

use App\Factory\CategoryFactory;
use App\Interface\Controller\iCategoryRepository;
use App\Interface\Factory\iCategoryFactory;
use App\Interface\UseCase\iCategoryUseCase;
use App\Trait\AbstractUseCase;

class CategoryUseCase implements iCategoryUseCase
{
    use AbstractUseCase;

    private iCategoryFactory $categoryFactory;
    private string $entityName;

    public function __construct(
        private readonly iCategoryRepository $repository
    ) {
        $this->categoryFactory = new CategoryFactory();
        $this->entityName = 'category';
    }
}
