<?php
namespace App\Controller\Traits;

use Cake\Datasource\InvalidPropertyInterface;
use Cake\Http\Response;

/**
 * Trait ResponseTrait
 * @package App\Controller\Traits
 * @property Response $response
 */
trait ResponseTrait
{
    /**
     * Retornar uma resposta com dados e tipo json
     * @param $json
     * @param int $code
     * @return \Cake\Http\Response
     */
    protected function responseJson($json, int $code = 200)
    {
        return $this->response
            ->withStatus($code)
            ->withType('application/json')
            ->withStringBody(json_encode($json));
    }

    protected function responseWithSuccess($data, $additional = [], $meta = [])
    {
        $result = [
            'data' => $data
        ];

        if (!empty($additional)) {
            $result = array_merge($result, $additional);
        }

        if (!empty($meta)) {
            $result['meta'] = $meta;
        }

        return $this->responseJson($result);
    }

    /**
     * @param InvalidPropertyInterface $entity
     * @param string $message
     * @param array $meta
     * @param int $status
     * @return \Cake\Http\Response
     */
    protected function responseWithErrors(
        InvalidPropertyInterface $entity,
        string $message = 'Houve um erro ao validar essa requisição',
        array $meta = [],
        int $status = 400
    )
    {
        return $this->responseJson([
            'errors' => $entity->getInvalid(),
            'messages' => $entity->getErrors(),
            'message' => $message,
            'meta' => $meta
        ], $status);
    }

    /**
     * @return \Cake\Http\Response
     */
    protected function responseNotImplemented()
    {
        return $this->response
            ->withStatus(501);
    }

    protected function responseNotContent()
    {
        return $this->response
            ->withStatus(204);
    }

    protected function responseNotFound()
    {
        return $this->response
            ->withStatus(404);
    }

    /**
     * @return \Cake\Http\Response
     */
    protected function responseOk()
    {
        return $this->response
            ->withStatus(201);
    }
}
