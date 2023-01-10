<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController {

    public function index(Request $request) {
        return new Response('my framework');
    }
}