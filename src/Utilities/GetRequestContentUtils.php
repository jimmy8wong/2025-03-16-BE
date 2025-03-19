<?php

namespace App\Utilities;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

readonly final class GetRequestContentUtils
{
    private const EXCEPTION_MESSAGE_INVALID_REQUEST_OBJECT = 'Invalid Request object';

    public function __invoke(Request $request): array
    {
        $jsonObj = json_decode($request->getContent(), true);

        if ($jsonObj === null) {
            throw new BadRequestException(self::EXCEPTION_MESSAGE_INVALID_REQUEST_OBJECT);
        }

        return $jsonObj;
    }
}