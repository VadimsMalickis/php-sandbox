<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller {

    public function homeAction(Request $request): Response
    {
        return Application::renderTemplate('home.php');
    }

    public function contactAction(Request $request, $username): Response {
        return Application::renderTemplate('contact.php', [
            'username' => $username
        ]);
    }


}