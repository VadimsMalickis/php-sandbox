<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller {

    public function homeAction(Request $request): Response
    {
        return Application::renderTemplate('home.php');
    }
}