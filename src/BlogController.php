<?php

declare(strict_types=1);

namespace App;

use App\Core\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function indexAction(): Response
    {
    

        try {
            // new DateTime will throw an error if user date was corrupt
            $dob = new \DateTime($dob);
        } catch (\Exception $e) {
            // errors[] = 'something' is same as array_push(...)
            $errors[] = 'Invalid date!';
            exit();
        }

        $minInterval = \DateInterval::createFromDateString('18 years');
        $maxInterval = \DateInterval::createFromDateString('130 years');


        $minDobLimit = ( new \DateTime() )->sub($minInterval);
        $maxDobLimit = ( new \DateTime() )->sub($maxInterval);

        if ($dob <= $maxDobLimit) {
            $errors[] = 'You must be alive to use this service.';
            exit();
        }
        if ($dob >= $minDobLimit) {
            $errors[] = 'Not 18+ years!';
            exit();
        }

        return $this->render('blog.html');
    }



}