<?php

namespace App\UseCase;

use App\Entity\Video;
use App\Factory\VideoFactory;
use App\Interface\Factory\iVideoFactory;
use App\Interface\Repository\iVideoRepository;
use App\Interface\UseCase\iVideoUseCase;
use App\Presentation\Error\NotFoundError;

class VideoUseCase implements iVideoUseCase
{
    private iVideoFactory $videoFactory;

    public function __construct(private iVideoRepository $videoRepository)
    {
        $this->videoFactory = new VideoFactory();
    }

    /**
     * @return Video[]
     */
    public function all(): array
    {
        return $this->videoRepository->all();
    }

    /**
     * @param string $requestData
     * @return void
     */
    public function create(string $requestData): void
    {
        $data = json_decode($requestData);

        $this->videoFactory->validateEntityParams($data);

        $entity = $this->videoFactory->createEntity($data);

        $this->videoRepository->add($entity);

        return;
    }

    /**
     * @param int $id
     * @return Video
     */
    public function show(int $id): Video
    {
        $this->videoFactory->validateEntityId($id);

        $entity = $this->checkIfEntityExists($id);

        return $entity;
    }

    /**
     * @param string $requestData
     * @param int $id
     * @return void
     */
    public function update(string $requestData, int $id): void
    {
        $data = json_decode($requestData);

        $this->videoFactory->validateEntityId($id);

        $existEntity = $this->checkIfEntityExists($id);
        $entity = $this->videoFactory->updateEntity($data, $existEntity);

        $this->videoRepository->update($entity, $id);

        return;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->videoFactory->validateEntityId($id);
        $this->checkIfEntityExists($id);
        $this->videoRepository->delete($id);

        return;
    }

    /**
     * @param int $id
     * @return Video
     * @throws NotFoundError
     */
    private function checkIfEntityExists(int $id): Video
    {
        $doesEntityExists = $this->videoRepository->show($id);
        if (is_null($doesEntityExists)) {
            throw new NotFoundError('video');
        }

        return $doesEntityExists;
    }
}
