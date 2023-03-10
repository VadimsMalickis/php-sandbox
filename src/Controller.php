<?php

namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public function homeAction(Request $request): Response
    {
        $productCategory = [
            'Computers' => [],
            'Furniture' => []
        ];


        return $this->render('home.html');
    }

    public function contactAction(Request $request, $username): Response
    {

//        return Application::render('contact.html', [
//            'username' => $username
//        ]);
    }

    private function render(string $templateName, array $arguments = []): Response
    {
        return new Response(
            $this->container->get('twig')->render($templateName, $arguments)
        );
    }
}
