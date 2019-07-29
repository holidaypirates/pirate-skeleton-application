<?php declare(strict_types=1);

namespace PirateApplicationIntegrationTest\ApiSchema;

use PirateApplication\HTTP\API\V1\RequestHandler\PingRequestHandler;
use PirateApplicationIntegrationTest\Helper\AbstractIntegrationTest;
use PaddleHq\OpenApiValidator\OpenApiValidatorFactory;
use PaddleHq\OpenApiValidator\OpenApiValidatorInterface;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class PingRequestHandlerTest extends AbstractIntegrationTest
{
    public function testPingEndpoint(): void
    {
        $request = new ServerRequest();
        $requestHandler = $this->getContainer()->get(PingRequestHandler::class);
        $response = $requestHandler->handle($request);

        $validator = $this->getValidator();

        TestCase::assertTrue($validator->validateResponse(
            $response,
            '/ping',
            $request->getMethod(),
            $response->getStatusCode(),
            $response->getHeaderLine('Content-Type')
        ));
    }

    private function getValidator(): OpenApiValidatorInterface
    {
        $validatorFactory = new OpenApiValidatorFactory();
        $path = realpath(__DIR__.'/../../../docs/API/V1/schema.json');

        return $validatorFactory->v3Validator('file://'.$path);
    }
}
