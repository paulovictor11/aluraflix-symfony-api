<?php

namespace App\Presentation\Helper;

use App\Interface\Helper\iHttpResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HttpResponse implements iHttpResponse
{
    /** @return JsonResponse */
    public static function serverError(): JsonResponse
    {
        return new JsonResponse(
            ['message' => 'Internal Server Error'],
            Response::HTTP_INTERNAL_SERVER_ERROR,
        );
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public static function unauthorized(string $message): JsonResponse
    {
        return new JsonResponse(
            ['message' => $message],
            Response::HTTP_UNAUTHORIZED,
        );
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public static function badRequest(?string $message = ""): JsonResponse
    {
        return new JsonResponse(
            ['message' => $message ?? 'Unexpected Error'],
            Response::HTTP_BAD_REQUEST,
        );
    }

    /** @return JsonResponse */
    public static function created(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    /**
     * @param array|object $body
     * @return JsonResponse
     */
    public static function ok(array|object $body = null): JsonResponse
    {
        return new JsonResponse($body, Response::HTTP_OK);
    }
}
