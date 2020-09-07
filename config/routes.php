<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    $builder->registerMiddleware('assets', new AssetMiddleware([
        'cacheTime' => Configure::read('Asset.cacheTime'),
    ]));
    /**
     * Api Docs Swagger 3.0 (OpenApi)
     */
    $builder->connect('/docs', ['controller' => 'Swagger', 'action' => 'index', 'plugin' => 'SwaggerBake'])
        ->setMiddleware(['assets']);
    $builder->post('/token', ['controller' => 'Users', 'action' => 'token']);
});

$routes->scope('/api', function(RouteBuilder $builder){
    $builder->resources('Companies');
});
