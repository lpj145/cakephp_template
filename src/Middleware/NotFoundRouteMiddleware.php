<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Response;
use Cake\Routing\Exception\MissingRouteException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * NotFoundRoute middleware
 */
class NotFoundRouteMiddleware implements MiddlewareInterface
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
        } catch (MissingRouteException $exception) {
            return (new Response())
                ->withStatus(404)
                ->withStringBody($this->getMiniTemplate());
        }
    }

    public function getMiniTemplate(): string
    {
        return <<< EOD
<!DOCTYPE html>  
<html>
    <head>
        <title>404 - Not Found</title>
        <style>
            body {
                background-color: #f3f3f3;
                display: flex;
                height: 100vh;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #878787;
            }
            .error-header {
                font-size: 64px;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <h2 class="error-header">404</h2>
        <p>Page cannot be found.</p>
    </body>
</html>
EOD;
    }
}
