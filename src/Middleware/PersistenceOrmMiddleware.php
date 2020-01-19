<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Exception\PersistenceException;
use App\Exception\ValidationException;
use Cake\Datasource\EntityInterface;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * PersistenceOrm middleware
 */
class PersistenceOrmMiddleware implements MiddlewareInterface
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
        } catch (ValidationException $exception) {
            return $this->responseWithErrors(
                $exception->getEntity(),
                'Essa requisição contém dados inválidos.'
            );
        } catch (PersistenceException $exception) {
            return $this->responseWithErrors(
                $exception->getEntity(),
                'Houve um erro ao tentar persistir esses dados.'
            );
        }
    }

    protected function responseWithErrors(EntityInterface $entity, string $message = '', $meta = null)
    {
        $result = [
            'invalids' => $entity->getInvalid(),
            'errors' => $this->enhanceErrors($entity->getErrors()),
            'message' => $message
        ];

        if (!is_null($meta)) {
            $result['meta'] = $meta;
        }

        return $this->responseWithJson($result, 400);
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

    /**
     * @param array $errors
     * @return array
     */
    private function enhanceErrors(array $errors): array
    {
        return array_reduce(array_keys($errors), function($oldErrors, $fieldName) use($errors){
            $oldErrors[$fieldName] = array_values($errors[$fieldName]);
            return $oldErrors;
        }, []);
    }
}
