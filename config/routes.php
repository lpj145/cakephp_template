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
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;


/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    $builder->registerMiddleware('bodyparser', \Cake\Http\Middleware\BodyParserMiddleware::class);
    $builder->applyMiddleware('bodyparser');

    $builder->get('/ping', ['controller' => 'Ping', 'action' => 'index']);

    $builder->post('/token', ['controller' => 'Users', 'action' => 'token']);

    // Companies Routes
    $builder->post('/companies', ['controller' => 'Companies', 'action' => 'add']);
    $builder->get('/companies', ['controller' => 'Companies', 'action' => 'index']);

    $builder->patch('/companies/:id/deactivate', ['controller' => 'Companies', 'action' => 'deactivate'])
        ->setPass(['id'])
    ;
    $builder->patch('/companies/:id/active', ['controller' => 'Companies', 'action' => 'active'])
        ->setPass(['id'])
    ;

    if (Configure::read('debug')) {
        $builder->get('/debug', ['controller' => 'App', 'action' => 'debug']);
    }

    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
