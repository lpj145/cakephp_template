<?php
declare(strict_types=1);

namespace App;

use App\Middleware\ErrorsMiddlewareMiddleware;
use App\Middleware\NotFoundRouteMiddleware;
use App\Middleware\PersistenceOrmFailedMiddleware;
use App\Middleware\UnauthenticatedMiddleware;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        if (Configure::read('debug')) {
            $this->addOptionalPlugin('DebugKit');
        }

        $this->addPlugin('Authentication');
        $this->addPlugin('ExpressRequest');
        $this->addPlugin('SwaggerBake');
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService([
            'identifiers' => [
                'Authentication.Password',
                'Authentication.JwtSubject'
            ],
            'authenticators' => [
                'Authentication.Form' => [
                    'loginUrl' => '/token'
                ],
                'Authentication.Jwt' => [
                    'returnPayload' => false
                ]
            ]
        ]);


        return $service;
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new NotFoundRouteMiddleware())
            ->add(new RoutingMiddleware($this))
            ->add(new UnauthenticatedMiddleware())
            ->add(new BodyParserMiddleware())
            ->add(new AuthenticationMiddleware($this))
            ->add(new PersistenceOrmFailedMiddleware())
            ->add(new ErrorsMiddlewareMiddleware());

        return $middlewareQueue;
    }

    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');
    }
}
