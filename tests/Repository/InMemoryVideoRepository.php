<?php

namespace Tests\Repository;

use App\Entity\Video;
use App\Interface\Repository\iVideoRepository;
use Tests\Entity\VideoMock;

class InMemoryVideoRepository implements iVideoRepository
{
    public array $items = [];

    /**
     * @return Video[]
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @param Video $video
     * @return void
     */
    public function add(Video $video): void
    {
        $this->items[] = $video;
        return;
    }

    /**
     * @param int $id
     * @return ?Video
     */
    public function show(int $id): ?Video
    {
        $key = $this->findById($id);
        return $this->items[$key];
    }

    /**
     * @param Video $video
     * @param int $id
     * @return void
     */
    public function update(Video $video, int $id): void
    {
        $key = $this->findById($id);
        $this->items[$key] = $video;
        return;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $key = $this->findById($id);
        unset($this->items[$key]);
        return;
    }

    /**
     * @param int $id
     * @return array|null
     */
    private function findById(int $id): array|null
    {
        foreach ($this->items as $key => $item) {
            if ($item['id'] === $id) {
                return $key;
            }
        }

        return null;
    }
}
