<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Controller\Controller;
use Cake\Datasource\InvalidPropertyInterface;

/**
 * Ponto inicial de todos os controles
 * @property AuthenticationComponent $Authentication
 */
class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Authentication.Authentication', [
            'requireIdentity' => true
        ]);
    }

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

    /**
     * @return \Cake\Http\Response
     */
    protected function responseOk()
    {
        return $this->response
            ->withStatus(201);
    }
}
