<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller {

    public function homeAction(Request $request, $name, $age): Response
    {
        return Application::renderTemplate('home.php', $request);
    }
}