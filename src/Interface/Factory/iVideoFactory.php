<?php

namespace App\Interface\Factory;

use App\Entity\Video;

interface iVideoFactory
{
    public function createEntity(object $video): Video;
    public function updateEntity(object $update, object $exist): Video;
    public function validateEntityId(int $id): void;
    public function validateEntityParams(object $video): void;
}
