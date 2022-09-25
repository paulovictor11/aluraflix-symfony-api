<?php

namespace App\Trait;

use App\Presentation\Error\NotFoundError;
use App\Util\Error\MissingParamError;

trait AbstractUseCase
{
    /**
     * @return object[]
     */
    public function all(array $filter, array $sort, int $page, int $perPage): array
    {
        return $this->repository->all(
            $filter,
            $sort,
            $page,
            $perPage
        );
    }

    /**
     * @param string $requestData
     * @return void
     */
    public function create(string $requestData): void
    {
        $data = json_decode($requestData);
        $entity = $this->factory->createEntity($data);

        $this->repository->add($entity);
    }

    /**
     * @param int $id
     * @return object
     * @throws MissingParamError
     * @throws NotFoundError
     */
    public function show(int $id): object
    {
        $this->factory->validateEntityId($id);
        return $this->checkIfEntityExists($id);
    }

    /**
     * @param string $requestData
     * @param int $id
     * @return void
     * @throws MissingParamError
     * @throws NotFoundError
     */
    public function update(string $requestData, int $id): void
    {
        $data = json_decode($requestData);

        $this->factory->validateEntityId($id);

        $existEntity = $this->checkIfEntityExists($id);
        $entity = $this->factory->updateEntity($data, $existEntity);

        $this->repository->update($entity, $id);
    }

    /**
     * @param int $id
     * @return void
     * @throws MissingParamError
     * @throws NotFoundError
     */
    public function delete(int $id): void
    {
        $this->factory->validateEntityId($id);
        $this->checkIfEntityExists($id);
        $this->repository->delete($id);
    }

    /**
     * @param int $id
     * @return object
     * @throws NotFoundError
     */
    private function checkIfEntityExists(int $id): object
    {
        $doesEntityExists = $this->repository->show($id);
        if (is_null($doesEntityExists)) {
            throw new NotFoundError($this->entityName);
        }

        return $doesEntityExists;
    }
}
