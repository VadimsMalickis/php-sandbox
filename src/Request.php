<?php

namespace App;

class Request {

    private $requestMethod;
    private $requestUri;
    private $getParams;
    private $postParams;

    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'] ?? null;
        $this->requestUri = $_SERVER['REQUEST_URI'] ?? null;
        $this->getParams = $_GET;
        $this->postParams = $_POST;
    }

}