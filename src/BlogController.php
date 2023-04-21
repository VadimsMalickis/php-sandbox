<?php

declare(strict_types=1);

namespace App;

use App\Core\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function indexAction(): Response
    {
        return $this->render('blog.html');
    }

}
