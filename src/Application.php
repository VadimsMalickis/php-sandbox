<?php

namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Application
{
    private ContainerBuilder $container;

    private RouteCollection $routeCollection;

    public function __construct(RouteCollection $routes)
    {
        $this->container = $this->buildContainer();

        $this->routeCollection = $routes;
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

        $controller[0]->setContainer($this->container);

        if (!is_callable($controller)) {
            return new Response('Bad Request', 500);
        } else {
            $arguments = $argumentResolver->getArguments($request, $controller);
            return call_user_func_array($controller, $arguments);
        }
    }

    private function buildContainer()
    {
        $container = new ContainerBuilder();

        $container->register('twig_file_loader', FilesystemLoader::class)
            ->addArgument(__DIR__ . '/../views');
        $container->register('twig', Environment::class)
            ->addArgument(new Reference('twig_file_loader'));

        return $container;
    }

}
