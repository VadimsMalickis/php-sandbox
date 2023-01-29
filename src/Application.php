<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application
{
  public $database;

  public function __construct()
  {
    $this->database = new Database();
  }

    /**
     * @param Request $request
     * @return Response
     */
    public static function renderTemplate($templateFile, Request $request): Response
    {
        extract($request->attributes->all(), EXTR_SKIP);

        ob_start();
        require sprintf(__DIR__ . '/../views/%s', $templateFile);
        $view = ob_get_clean();
        ob_start();
        require __DIR__.'/../views/main.php';
        $main = ob_get_clean();

        return new Response(str_replace('{{ content }}', $view, $main));
    }
}
