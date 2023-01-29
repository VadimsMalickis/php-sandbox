<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once __DIR__ .  "/vendor/autoload.php";

$routes = include __DIR__.'/routes.php';
$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);

} catch (ResourceNotFoundException|Exception $exception) {
    $response = new Response($exception->getMessage(), 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}
$response->send();
