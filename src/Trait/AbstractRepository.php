<?php

namespace App\Trait;

use Doctrine\ORM\Exception\ORMException;

trait AbstractRepository
{
    /**
     * @return object[]
     */
    public function all(array $filter, array $sort, int $page, int $perPage): array
    {
        return $this->findBy(
            $filter,
            $sort,
            $perPage,
            ($page - 1) * $perPage
        );
    }

    /**
     * @param object $object
     * @return void
     */
    public function add(object $object): void
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $id
     * @return ?object
     */
    public function show(int $id): ?object
    {
        $entity = $this->findOneBy(['id' => $id]);
        if (is_null($entity)) {
            return null;
        }

        return $entity;
    }

    // /**
    //  * @param object $object
    //  * @param int $id
    //  * @return void
    //  */
    // public function update(object $object, int $id): void
    // {
    // }

    /**
     * @param int $id
     * @return void
     * @throws ORMException
     */
    public function delete(int $id): void
    {
        $entity = $this->getEntityManager()->getReference($this->entityClass, $id);

        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
