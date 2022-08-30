<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity()]
#[ORM\Table(name: 'categories')]
class Category implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    private string $color;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private DateTimeImmutable $updatedAt;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'color' => $this->color
        ];
    }
}
