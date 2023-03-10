<?php


use App\Application;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ .  "/../vendor/autoload.php";


$routes = include __DIR__ . '/../routes.php';
$request = Request::createFromGlobals();

$app = new Application($routes);
$response = $app->handleRequest($request);
$response->send();
