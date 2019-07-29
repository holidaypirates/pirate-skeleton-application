<?php declare(strict_types=1);

use PirateApplication\HTTP\API\V1\RequestHandler\PingRequestHandler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', PirateApplication\RequestHandler\HomePageHandler::class, 'home');
 * $app->post('/album', PirateApplication\RequestHandler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', PirateApplication\RequestHandler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', PirateApplication\RequestHandler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', PirateApplication\RequestHandler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', PirateApplication\RequestHandler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', PirateApplication\RequestHandler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     PirateApplication\RequestHandler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/api/v1/ping', PingRequestHandler::class);
};
