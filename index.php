<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ .  "/vendor/autoload.php";

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
} else {
    echo "<p>Welcome to PHP</p>";
}

include 'views/base-html.php';
/**
 * Rendering function
 *
 * @param Request $request
 * @return Response
 */
function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__ . '/views/%s.php', $_route);

    return new Response(ob_get_clean());
}
