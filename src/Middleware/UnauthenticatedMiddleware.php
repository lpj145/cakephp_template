<?php
declare(strict_types=1);

namespace App\Middleware;

use Authentication\Authenticator\UnauthenticatedException;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Unauthenticated middleware
 */
class UnauthenticatedMiddleware implements MiddlewareInterface
{
    /**
     * Process method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (UnauthenticatedException $exception) {
            return (new Response())
                ->withStatus(401)
                ->withStringBody('Authentication needed.');
        }
    }
}
