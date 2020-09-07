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

use App\Controller\Traits\AuthTrait;
use App\Controller\Traits\ResponseTrait;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Controller\Controller;
use ExpressRequest\Controller\Component\ExpressRequestComponent;

/**
 * Application Controller
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 * @property AuthenticationComponent $Authentication
 * @property ExpressRequestComponent $ExpressRequest
 */
class AppController extends Controller
{
    use AuthTrait,
        ResponseTrait;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('ExpressRequest.ExpressRequest');

        // Actually is a hack, is some months is still solved.
        if ($this->request->getParam('plugin') === 'SwaggerBake') {
            $this->Authentication->allowUnauthenticated(['index']);
        }

    }
}
