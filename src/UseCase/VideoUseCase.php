<?php

namespace App\UseCase;

use App\Entity\Video;
use App\Factory\VideoFactory;
use App\Interface\Controller\iCategoryRepository;
use App\Interface\Factory\iVideoFactory;
use App\Interface\Repository\iVideoRepository;
use App\Interface\UseCase\iVideoUseCase;
use App\Trait\AbstractUseCase;
use App\Util\Error\MissingParamError;

class VideoUseCase implements iVideoUseCase
{
    use AbstractUseCase;

    private iVideoFactory $factory;

    public function __construct(
        private readonly iVideoRepository $repository,
        private readonly iCategoryRepository $categoryRepository
    ) {
        $this->factory = new VideoFactory($categoryRepository);
    }

    /**
     * @param int $categoryId
     * @return Video[]
     * @throws MissingParamError
     */
    public function findByCategory(int $categoryId): array
    {
        if (empty($categoryId)) {
            throw new MissingParamError('category id');
        }

        return $this->repository->findByCategory($categoryId);
    }

    /**
     * @param string $title
     * @return array
     * @throws MissingParamError
     */
    public function findByName(string $title): array
    {
        if (empty($title)) {
            throw new MissingParamError("video title");
        }

        return $this->repository->findByName($title);
    }

    /**
     * @return array
     */
    public function freeVideos(): array
    {
        return $this->repository->freeVideos();
    }
}
