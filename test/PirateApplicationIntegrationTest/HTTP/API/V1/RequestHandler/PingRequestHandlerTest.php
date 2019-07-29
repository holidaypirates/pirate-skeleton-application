<?php declare(strict_types=1);

namespace PirateApplicationIntegrationTest\HTTP\API\V1\RequestHandler;

use PHPUnit\Framework\TestCase;
use PirateApplication\HTTP\API\V1\RequestHandler\PingRequestHandler;
use PirateApplicationIntegrationTest\Helper\AbstractIntegrationTest;
use Zend\Diactoros\ServerRequest;

class PingRequestHandlerTest extends AbstractIntegrationTest
{
    public function testPingEndpoint(): void
    {
        $request = new ServerRequest();
        $requestHandler = $this->getContainer()->get(PingRequestHandler::class);
        $response = $requestHandler->handle($request);
        TestCase::assertEquals(200, $response->getStatusCode());

        $expectedResponseBody = [
            'ping' => 'pong',
        ];

        $generatedResponseBody = json_decode((string)$response->getBody(), true);
        TestCase::assertEquals($expectedResponseBody, $generatedResponseBody);
    }
}
