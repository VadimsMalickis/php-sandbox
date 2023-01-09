<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ .  "/vendor/autoload.php";

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/'        => __DIR__ . '/views/base-html.php',
    '/blog'    => __DIR__ . '/views/blog.php',
    '/contact' => __DIR__ . '/views/contact.php',
    '/news'    => __DIR__ . '/views/news.php',
    '/about'   => __DIR__ . '/views/about.php'

];

$path = $request->getPathInfo();

if (isset($map[$path])) {
    ob_start();
    include $map[$path];
    $response->setContent(ob_get_clean());
} else {
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->prepare($request);
$response->send();
