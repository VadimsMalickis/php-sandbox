<?php

namespace App;

use App\Database;
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
    public static function render(Request $request): Response
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__ . '/views/%s.php', $_route);

        return new Response(ob_get_clean());
    }
}
