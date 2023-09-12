<?php

declare(strict_types=1);

namespace App;

use App\Core\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function indexAction(): Response
    {
    


        // validate $blogMsg to match only letters
        if (! preg_match('/^[a-zA-Z\s]+$/', $blogMsg)) {
            throw new \Exception('Invalid blog message');
        }

        return $this->render('blog.html');
    }



}