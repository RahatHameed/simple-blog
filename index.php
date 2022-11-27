<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Router;

try {
    session_start();
    $request = Request::createFromGlobals();
    $fileLocator = new FileLocator(array(__DIR__));
    $requestContext = new RequestContext();
    $requestContext->fromRequest($request);

    $router = new Router(
        new YamlFileLoader($fileLocator),
        'routes.yaml',
        array('cache_dir' => __DIR__ . '/cache'),
        $requestContext
    );
    $routes = new RouteCollection();
    $routes->addCollection($router->getRouteCollection());
    $matcher = new UrlMatcher($routes, $requestContext);
    $attributes = $matcher->match($request->getPathInfo());
    $request->attributes->add($attributes);
    $dispatcher = new EventDispatcher();
    $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));
    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();
    $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);
}
catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}
