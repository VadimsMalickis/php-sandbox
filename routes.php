<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

require_once __DIR__ .  "/vendor/autoload.php";


$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => [\App\Controller::class, 'homeAction']
]));

$routes->add('blog', new Route('/blog'));
$routes->add('contact', new Route('/contact'));
$routes->add('news', new Route('/news'));
$routes->add('about', new Route('/about'));

return $routes;
