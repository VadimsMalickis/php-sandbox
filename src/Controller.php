<?php

namespace App;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    public ?ContainerInterface $container;

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

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
