<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Exception\EntityNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * NotFoundEntity middleware
 */
class NotFoundEntityMiddleware extends PersistenceOrmFailedMiddleware implements MiddlewareInterface
{
    public const HTTP_NOT_FOUND = 404;
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
        } catch (EntityNotFoundException $exception) {
            return $this->responseWithJson(['message' => 'resource not found.'], self::HTTP_NOT_FOUND);
        }
    }
}
