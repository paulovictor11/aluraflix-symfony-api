<?php

namespace App\Util\Helper;

use App\Interface\Helper\iTokenGenerator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Util\Error\MissingParamError;

class TokenGenerator implements iTokenGenerator
{
    /**
     * @param int $id
     * @return string
     * @throws MissingParamError
     */
    public static function generate(int $id): string
    {
        if (empty($id)) {
            throw new MissingParamError('id');
        }

        return JWT::encode(['id' => $id], 'secret', 'HS256');
    }

    /**
     * @param string $token
     * @return bool
     * @throws MissingParamError
     */
    public static function validate(string $token): bool
    {
        if (empty($token)) {
            throw new MissingParamError('token');
        }

        $decoded = self::decode($token);

        return property_exists($decoded, 'id');
    }

    /**
     * @param string $token
     * @return object
     * @throws MissingParamError
     */
    public static function decode(string $token): object
    {
        if (empty($token)) {
            throw new MissingParamError('token');
        }

        return JWT::decode($token, new Key('secret', 'HS256'));
    }
}
