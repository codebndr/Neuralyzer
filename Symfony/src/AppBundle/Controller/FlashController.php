<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlashController extends Controller
{
    /**
    * @Route("/flash")
    */
    public function showAction()
    {
        return $this->render('AppBundle:Flash:index.html.twig');
    }
}
