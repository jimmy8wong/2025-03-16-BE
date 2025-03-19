<?php

namespace App\Tests\Unit\Utilies;

use App\Utilities\GetRequestContentUtils;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class GetRequestContentUtilsTest extends TestCase
{
    private GetRequestContentUtils $util;

    protected function setUp(): void
    {
        $this->util = new GetRequestContentUtils();
    }

    public function testRequestContent()
    {
        $request = new Request([], [], [], [], [], [], json_encode([
            'Power' => '8 bhp'
        ]));
        
        $result = $this->util->__invoke($request);
        $this->assertEquals(['Power' => '8 bhp'], $result);
    }

    public function testRequestException()
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Invalid Request object');

        $request = new Request([], [], [], [], [], [], 'test invalid content');

        $this->util->__invoke($request);
    }
}