<?php

namespace Somecode\Framework\Http;

use FastRoute\RouteCollector;
use Somecode\Framework\Http\Response;
use Somecode\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }

            $collector->get('/', function () {

                return new Response("Hello World!");
            });

            $collector->get('/posts/{id}', function (array $vars) {
                $content = "<h1>Post - {$vars['id']}</h1>";

                return new Response($content);
            });
        });

        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getPath()
        );

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                return new Response('404 Not Found', 404);

            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                return new Response('405 Method Not Allowed', 405);

            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                return $handler($vars);

            default:
                return new Response('500 Internal Server Error', 500);
        }
    }
}