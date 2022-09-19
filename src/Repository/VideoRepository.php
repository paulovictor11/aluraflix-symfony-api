<?php

namespace App\Repository;

use App\Entity\Video;
use App\Interface\Repository\iVideoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class VideoRepository extends ServiceEntityRepository implements iVideoRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @return Video[]
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
     * @param Video $video
     * @return void
     */
    public function add(Video $video): void
    {
        $this->getEntityManager()->persist($video);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $id
     * @return ?Video
     */
    public function show(int $id): ?Video
    {
        $entity = $this->findOneById($id);
        if (is_null($entity)) {
            return null;
        }

        return $entity;
    }

    /**
     * @param Video $video
     * @param int $id
     * @return void
     * @throws ORMException
     */
    public function update(Video $video, int $id): void
    {
        /** @var Video $entity */
        $entity = $this->getEntityManager()->getReference(Video::class, $id);

        $entity->title = $video->title;
        $entity->description = $video->description;
        $entity->url = $video->url;
        $entity->updatedAt = $video->updatedAt;

        $this->getEntityManager()->flush();
    }

    /**
     * @param int $id
     * @return void
     * @throws ORMException
     */
    public function delete(int $id): void
    {
        $entity = $this->getEntityManager()->getReference(Video::class, $id);

        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $categoryId
     * @return Video[]
     */
    public function findByCategory(int $categoryId): array
    {
        return $this->findBy(["category" => $categoryId]);
    }

    /**
     * @param string $title
     * @return array
     */
    public function findByName(string $title): array
    {
        $qb = $this->createQueryBuilder('v')
            ->where('v.title LIKE :title')
            ->setParameter('title', "%$title%");

        $query = $qb->getQuery();
        return $query->execute();
    }
}
