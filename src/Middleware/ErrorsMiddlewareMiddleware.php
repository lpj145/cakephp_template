<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Exception\InvalidArgumentException;
use App\Exception\UploadFileException;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * ErrorsMiddleware middleware
 */
class ErrorsMiddlewareMiddleware implements MiddlewareInterface
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
        } catch (InvalidArgumentException $exception) {
            return $this->responseWithJson([
                'message' => $exception->getMessage()
            ], $exception->getCode());
        } catch (UploadFileException $exception) {
            return $this->responseWithJson(
                [
                    'errors' => $exception->getErrors(),
                    'message' => 'Houve um erro na importação desse arquivo.',
                    '_message' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        }
    }

    protected function responseWithJson($data, $status = 200)
    {
        return (new Response())
            ->withStatus($status)
            ->withType('application/json')
            ->withStringBody(
                json_encode($data)
            );
    }
}
