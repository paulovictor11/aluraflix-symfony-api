<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use App\Trait\AbstractEntity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'categories')]
class Category implements JsonSerializable
{
    use AbstractEntity;

    #[ORM\Column(type: Types::STRING)]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    private string $color;

    public function jsonSerialize(): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'color' => $this->color
        ];
    }
}
