<?php

namespace App\Repository;

use App\Entity\Video;
use App\Interface\Repository\iVideoRepository;
use App\Trait\AbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class VideoRepository extends ServiceEntityRepository implements iVideoRepository
{
    use AbstractRepository;

    private string $entityClass;

    public function __construct(ManagerRegistry $registry)
    {
        $this->entityClass = Video::class;
        parent::__construct($registry, Video::class);
    }

    /**
     * @param object $video
     * @param int $id
     * @return void
     * @throws ORMException
     */
    public function update(object $video, int $id): void
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
        $qb = $this
            ->createQueryBuilder('v')
            ->where('v.title LIKE :title')
            ->setParameter('title', "%$title%");

        $query = $qb->getQuery();
        return $query->execute();
    }

    /**
     * @return array
     */
    public function freeVideos(): array
    {
        return $this->findBy([], [], 10);
    }
}
