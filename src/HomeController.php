<?php

namespace App;

use App\Core\AbstractController;
use App\Event\EventDispatcher;
use App\Event\OnboardingNotification;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
//    public ContainerInterface $container;

    public function homeAction(Request $request): Response
    {



        return $this->render('home.html');
    }

    public function contactAction(Request $request, $username): Response
    {

        return $this->render('contact.html');
    }

    public function userAction(Request $request)
    {
        /**
         * The client code.
         */

        $repository = new UserRepository();
        EventDispatcher::getInstance()->attach($repository, "facebook:update");

        $logger = new Logger(__DIR__ . "/log.txt");
        EventDispatcher::getInstance()->attach($logger, "*");

        $onboarding = new OnboardingNotification("1@example.com");
        EventDispatcher::getInstance()->attach($onboarding, "users:created");

// ...

        $repository->initialize(__DIR__ . "users.csv");

// ...

        $user = $repository->createUser([
            "name" => "John Smith",
            "email" => "john99@example.com",
        ]);

// ...

        $user->delete();
    }

}
