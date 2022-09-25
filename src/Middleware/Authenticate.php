<?php

namespace App\Middleware;

use App\Util\Error\MissingParamError;
use App\Util\Helper\TokenGenerator;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Authenticate implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws MissingParamError
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $header = $request->getHeader('Authorization');
        if (empty($header)) {
            return new Response(
                HttpFoundationResponse::HTTP_UNAUTHORIZED,
                [],
                json_encode(['message' => 'Token is required'])
            );
        }

        $authorization = $header[0];
        if (!str_contains($authorization, 'Bearer')) {
            return new Response(
                HttpFoundationResponse::HTTP_UNAUTHORIZED,
                [],
                json_encode(['message' => 'Token Malformed'])
            );
        }

        $token = str_replace('Bearer ', '', $authorization);
        if (!TokenGenerator::validate($token)) {
            return new Response(
                HttpFoundationResponse::HTTP_UNAUTHORIZED,
                [],
                json_encode(['message' => 'Token is invalid'])
            );
        }

        return $handler->handle($request);
    }
}
