<?php


use App\Application;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ .  "/vendor/autoload.php";

$routes = include __DIR__.'/routes.php';
$request = Request::createFromGlobals();

$app = new Application($routes);
$templateEngine = new Environment(new FilesystemLoader(__DIR__.'/views'));
Application::withTemplateEngine($templateEngine);
$response = $app->handleRequest($request);

$response->send();
