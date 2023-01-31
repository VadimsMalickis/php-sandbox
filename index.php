<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require_once __DIR__ .  "/vendor/autoload.php";

$routes = include __DIR__.'/routes.php';
$request = Request::createFromGlobals();

// Specify our Twig templates location
$loader = new FilesystemLoader(__DIR__.'/views');
$twig = new Environment($loader);


// This thing works
// todo - replace custom rendering with twig 
//
// $name = 'vadims';

// echo $twig->render('twig.html', ['name' => $name]);
// exit();


$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$request->attributes->add($matcher->match($request->getPathInfo()));


$controller = $controllerResolver->getController($request);
if (!is_callable($controller)) {
    exit('Bad route!');
} else {
    $arguments = $argumentResolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);
}

$response->send();
