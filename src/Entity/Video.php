<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use App\Trait\AbstractEntity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
#[ORM\Table(name: 'videos')]
class Video implements JsonSerializable
{
    use AbstractEntity;

    #[ORM\Column(type: Types::STRING)]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    private string $description;

    #[ORM\Column(type: Types::STRING)]
    private string $url;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Category $category;

    public function jsonSerialize(): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'url'         => $this->url,
            'category'    => $this->category
        ];
    }
}
