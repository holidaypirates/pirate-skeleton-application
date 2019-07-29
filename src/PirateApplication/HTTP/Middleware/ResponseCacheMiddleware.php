<?php declare(strict_types=1);

/**
 * This class is a copy of \Middlewares\Cache that instead of just caching the headers
 * it serializes the whole response in the cache.
 */

namespace PirateApplication\HTTP\Middleware;

use DateTime;
use PirateApplication\Logger\LoggingTrait;
use function GuzzleHttp\Psr7\parse_response as parseResponse;
use function GuzzleHttp\Psr7\str as serializeMessage;
use Micheh\Cache\CacheUtil;
use Middlewares\Utils\Traits\HasResponseFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResponseCacheMiddleware implements MiddlewareInterface
{
    use HasResponseFactory;
    use LoggingTrait;

    public const CACHE_HEADER_NAME = 'PIRATE-CACHE';
    public const CACHE_HEADER_HIT = 'HIT';
    public const CACHE_HEADER_MISS = 'MISS';

    private $cache;
    private $responseTimeToLive;

    public function __construct(CacheItemPoolInterface $cache, string $responseTimeToLive)
    {
        $this->cache = $cache;
        $this->responseTimeToLive = $responseTimeToLive;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //Only GET & HEAD request
        if (!in_array($request->getMethod(), ['GET', 'HEAD'], true)) {
            return $handler
                ->handle($request)
                ->withHeader(self::CACHE_HEADER_NAME, self::CACHE_HEADER_MISS);
        }

        $util = new CacheUtil();
        $key = $request->getMethod() . md5((string)$request->getUri());
        $item = $this->cache->getItem($key);

        //It's cached
        if ($item->isHit()) {
            $response = parseResponse($item->get());
            $response = $response
                ->withStatus(200)
                ->withHeader(self::CACHE_HEADER_NAME, self::CACHE_HEADER_HIT);

            $this->getLogger()->info('Serving response from cache for ' . $request->getUri());

            return $response;
        }

        $this->getLogger()->info('Uncached request reached for ' . $request->getUri());

        $response = $handler
            ->handle($request)
            ->withHeader(self::CACHE_HEADER_NAME, self::CACHE_HEADER_MISS);

        if (!$response->hasHeader('Last-Modified')) {
            $response = $util->withLastModified($response, time());
        }

        $item->set(serializeMessage($response));
        $item->expiresAt(new DateTime($this->responseTimeToLive));
        $this->cache->save($item);

        return $response;
    }
}
