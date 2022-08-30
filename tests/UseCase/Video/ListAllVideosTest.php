<?php

namespace Tests\UseCase\Video;

use App\UseCase\VideoUseCase;
use Tests\Repository\InMemoryVideoRepository;

function makeSut(): array
{
    $repository = new InMemoryVideoRepository();
    $sut = new VideoUseCase($repository);

    return [
        $repository,
        $sut
    ];
}

it('should be able to list all the videos', function () {
    [, $sut] = makeSut();

    expect($sut->all())->not->toThrow(Exception::class);
});
