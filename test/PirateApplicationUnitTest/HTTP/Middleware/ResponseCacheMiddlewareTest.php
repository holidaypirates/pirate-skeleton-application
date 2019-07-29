<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\HTTP\Middleware;

use PirateApplication\HTTP\Middleware\ResponseCacheMiddleware;
use function GuzzleHttp\Psr7\str;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

class ResponseCacheMiddlewareTest extends TestCase
{
    public function testCacheMiss(): void
    {
        $uri = new Uri('https://pirate-app.test-cache-miss');
        $request = (new ServerRequest())->withUri($uri);

        $cache = $this->prophesize(CacheItemPoolInterface::class);
        $expectedKey = $request->getMethod() . md5((string)$request->getUri());

        $cacheItem = $this->prophesize(CacheItemInterface::class);
        $cacheItem->isHit()->willReturn(false);
        $cacheItem->set(Argument::any())->shouldBeCalled();
        $cacheItem->expiresAt(Argument::any())->shouldBeCalled();

        $cache->getItem($expectedKey)->willReturn($cacheItem->reveal());
        $cache->save(Argument::any())->shouldBeCalled();

        $middleware = new ResponseCacheMiddleware($cache->reveal(), '+30 minutes');

        $handler = new class implements RequestHandlerInterface
        {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                return new Response();
            }
        };

        $response = $middleware->process($request, $handler);

        TestCase::assertEquals(
            ResponseCacheMiddleware::CACHE_HEADER_MISS,
            $response->getHeaderLine(ResponseCacheMiddleware::CACHE_HEADER_NAME)
        );

        TestCase::assertEquals(200, $response->getStatusCode());
    }

    public function testCacheHit(): void
    {
        $uri = new Uri('https://pirate-app.test-cache-hit');
        $request = (new ServerRequest())->withUri($uri);

        $cache = $this->prophesize(CacheItemPoolInterface::class);
        $expectedKey = $request->getMethod() . md5((string)$request->getUri());

        $cacheItem = $this->prophesize(CacheItemInterface::class);
        $cacheItem->isHit()->willReturn(true);

        $response = (new Response())->withAddedHeader('Last-Modified', time());

        $cacheItem->get()->willReturn(str($response));

        $cache->getItem($expectedKey)->willReturn($cacheItem->reveal());

        $middleware = new ResponseCacheMiddleware($cache->reveal(), '+30 minutes');

        $handler = new class implements RequestHandlerInterface
        {
            public function handle(ServerRequestInterface $request): ResponseInterface
            {
                return new Response();
            }
        };

        $response = $middleware->process($request, $handler);

        TestCase::assertEquals(
            ResponseCacheMiddleware::CACHE_HEADER_HIT,
            $response->getHeaderLine(ResponseCacheMiddleware::CACHE_HEADER_NAME)
        );

        TestCase::assertEquals(200, $response->getStatusCode());
    }
}
