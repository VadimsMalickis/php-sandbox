<?php

use App\BlogController;
use App\HomeController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

require_once __DIR__ .  "/vendor/autoload.php";


$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => [HomeController::class, 'homeAction']
]));

$routes->add('contact', new Route('/contact/{username}', [
    '_controller' => [HomeController::class, 'contactAction'],
    'username' => null
]));

$routes->add('blog', new Route('/blog', [
    '_controller' => [BlogController::class, 'indexAction']
]));

$routes->add('news', new Route('/news'));
$routes->add('about', new Route('/about'));

return $routes;
