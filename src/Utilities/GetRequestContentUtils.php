<?php

namespace App\Utilities;

use Symfony\Component\HttpFoundation\Request;

readonly final class GetRequestContentUtils
{
    public function __invoke(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}