<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LandingController extends Controller
{
    /**
    * @Route("/")
    */
    public function showAction()
    {
        return $this->render('AppBundle:Landing:index.html.twig');
    }
}
