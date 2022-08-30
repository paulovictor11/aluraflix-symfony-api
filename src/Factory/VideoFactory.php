<?php

namespace App\Factory;

use App\Entity\Video;
use App\Interface\Factory\iVideoFactory;
use App\Interface\Helper\iUrlValidator;
use App\Util\Error\InvalidParamError;
use App\Util\Helper\UrlValidator;
use DateTimeImmutable;
use MissingParamError;

class VideoFactory implements iVideoFactory
{
    private iUrlValidator $urlValidator;

    public function __construct()
    {
        $this->urlValidator = new UrlValidator();
    }

    /**
     * @param Video $video
     * @return Video
     */
    public function createEntity(object $video): Video
    {
        $entity = new Video();
        $entity->title = $video->title;
        $entity->description = $video->description;
        $entity->url = $video->url;
        $entity->createdAt = new DateTimeImmutable();

        return $entity;
    }

    /**
     * @param Video $update
     * @param Video $exist
     * @return Video
     */
    public function updateEntity(object $update, object $exist): Video
    {
        $entity = new Video();
        $entity->title = $update->title;
        $entity->description = $update->description;
        $entity->url = $update->url;
        $entity->createdAt = $exist->createdAt;
        $entity->updatedAt = new DateTimeImmutable();

        return $entity;
    }

    /**
     * @param int $id
     * @return void
     */
    public function validateEntityId(int $id): void
    {
        if (is_null($id)) {
            throw new MissingParamError('id');
        }
    }

    /**
     * @param video $video
     * @return void
     */
    public function validateEntityParams(object $video): void
    {
        $properties = ['title', 'description', 'url'];

        foreach ($properties as $key) {
            if (!property_exists($video, $key)) {
                throw new MissingParamError($key);
            }

            if (empty($video->$key)) {
                throw new InvalidParamError($key);
            }

            if ($key == 'url' && !$this->urlValidator->isValid($video->url)) {
                throw new InvalidParamError('url');
            }
        }
    }
}