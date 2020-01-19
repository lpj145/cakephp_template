<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use Cake\Http\Response;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    const TOKEN_HOUR_LIVE = (HOUR * 2);

    /**
     * Verificar e retorna um token de autenticação com dados do usuário
     * @return Response
     */
    public function token(): Response
    {
        $result = $this->Authentication->getResult();
        $this->response = $this->response
            ->withStatus(401)
            ->withStringBody('Authentication needed!');

        if ($result->isValid()) {
            /** @var User $entity */
            $entity = $result->getData();
            $expireTime = time() + self::TOKEN_HOUR_LIVE;
            $tokenJwt = JWT::encode([
                'sub' => $entity->getIdentifier(),
                'exp' => $expireTime
            ],Security::getSalt());

            return $this->withJson([
                'token_type' => 'bearer',
                'token' => $tokenJwt,
                'token_expire' => $expireTime,
                'data' => $entity->getOriginalData()
            ]);
        }

        return $this->response;
    }
}
