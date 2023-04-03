<?php

namespace App;

use App\Core\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
//    public ContainerInterface $container;

    public function homeAction(Request $request): Response
    {



        return $this->render('home.html');
    }

    public function contactAction(Request $request, $username): Response
    {

        return $this->render('contact.html');
    }

}
