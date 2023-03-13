<?php


use App\Application;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ .  "/../vendor/autoload.php";
Debug::enable();

$routes = include __DIR__ . '/../routes.php';
$request = Request::createFromGlobals();

$app = new Application($routes);
$response = $app->handleRequest($request);
$response->send();
