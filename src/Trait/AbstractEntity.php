<?php

namespace App\Trait;

use App\Util\Error\InvalidParamError;
use App\Util\Error\MissingParamError;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait AbstractEntity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private DateTimeImmutable $updatedAt;

    /**
     * @throws InvalidParamError
     * @throws MissingParamError
     */
    public function __set($name, $value)
    {
        if (is_null($value)) {
            throw new MissingParamError($name);
        }

        if (empty($value)) {
            throw new InvalidParamError($name);
        }

        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
