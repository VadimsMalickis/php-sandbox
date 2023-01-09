<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

require_once __DIR__ .  "/vendor/autoload.php";


$routes = new RouteCollection();

$routes->add('base-html', new Route('/'));
$routes->add('blog', new Route('/blog'));
$routes->add('contact', new Route('/contact'));
$routes->add('news', new Route('/news'));
$routes->add('about', new Route('/about'));

return $routes;