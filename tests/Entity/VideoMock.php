<?php

namespace Tests\Entity;

use JsonSerializable;

class VideoMock implements JsonSerializable
{
    private int $id;
    private string $title;
    private string $description;
    private string $url;

    public function __construct(
        int $id,
        string $title,
        string $description,
        string $url
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'url'         => $this->url,
        ];
    }
}
