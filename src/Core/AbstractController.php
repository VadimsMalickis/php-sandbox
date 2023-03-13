<?php

namespace App\Core;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    public ContainerInterface $container;

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    protected function render(string $templateName, array $arguments = []): Response
    {
        return new Response(
            $this->container->get('twig')->render($templateName, $arguments)
        );
    }
}