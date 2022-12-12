<?php

namespace App;

use App\Database;

class Application
{
  public $database;

  public function __construct()
  {
    $this->database = new Database();
  }

  public function run()
  {
    return $this->database->host;
  }
}
