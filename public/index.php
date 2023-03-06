<?php


use App\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ .  "/../vendor/autoload.php";

$containerBuilder = new ContainerBuilder();



$routes = include __DIR__ . '/../routes.php';
$request = Request::createFromGlobals();

$app = new Application($routes);
$twig = new Environment(new FilesystemLoader(__DIR__ . '/../views'));
Application::setTemplateEngine($twig);
$response = $app->handleRequest($request);

$response->send();
