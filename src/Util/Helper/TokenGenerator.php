<?php

namespace App\Util\Helper;

use App\Interface\Helper\iTokenGenerator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use MissingParamError;

class TokenGenerator implements iTokenGenerator
{
    public static function generate(int $id): string
    {
        if (is_null($id)) {
            throw new MissingParamError('id');
        }

        return JWT::encode(['id' => $id], 'secret', 'HS256');
    }

    public static function validate(string $token): bool
    {
        if (is_null($token)) {
            throw new MissingParamError('token');
        }

        $decoded = self::decode($token);

        return property_exists($decoded, 'id');
    }

    public static function decode(string $token): object
    {
        if (is_null($token)) {
            throw new MissingParamError('token');
        }

        return JWT::decode($token, new Key('secret', 'HS256'));
    }
}
