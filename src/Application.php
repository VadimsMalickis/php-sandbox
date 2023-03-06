<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Twig\Environment;

class Application
{

    private static  Environment $twig;

    private RouteCollection $routeCollection;

    private static Container $container;

    public function __construct(RouteCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
        static::$container = new Container();
    }

    public function handleRequest(Request $request): Response
    {
        $context = new RequestContext();
        $context->fromRequest($request);
        $matcher = new UrlMatcher($this->routeCollection, $context);

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $request->attributes->add($matcher->match($request->getPathInfo()));

        $controller = $controllerResolver->getController($request);
        if (!is_callable($controller)) {
            return new Response('Bad Request', 500);
        } else {
            $arguments = $argumentResolver->getArguments($request, $controller);
            return call_user_func_array($controller, $arguments);
        }
    }

    public static function setTemplateEngine(Environment $twig): void {
        self::$twig = $twig;
    }
    public static function render(string $templateName, array $arguments = []): Response
    {
        return new Response(self::$twig->render($templateName, $arguments));
    }
}
