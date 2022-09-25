<?php

namespace App\Repository;

use App\Entity\Category;
use App\Interface\Controller\iCategoryRepository;
use App\Trait\AbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements iCategoryRepository
{
    use AbstractRepository;

    private string $entityClass;

    public function __construct(ManagerRegistry $registry)
    {
        $this->entityClass = Category::class;
        parent::__construct($registry, $this->entityClass);
    }

    /**
     * @param object $object
     * @param int $id
     * @return void
     * @throws ORMException
     */
    public function update(object $object, int $id): void
    {
        $entity = $this->getEntityManager()->getReference($this->entityClass, $id);

        $entity->title = $object->title;
        $entity->color = $object->color;
        $entity->updatedAt = $object->updatedAt;

        $this->getEntityManager()->flush();
    }
}
