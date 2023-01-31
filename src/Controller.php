<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller {

    public function homeAction(Request $request): Response
    {
        return Application::render('home.html');
    }

    public function contactAction(Request $request, $username): Response {

        return Application::render('contact.html', [
            'username' => $username
        ]);
    }

}