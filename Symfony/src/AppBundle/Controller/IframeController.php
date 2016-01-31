<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IframeController extends Controller
{
    /**
    * @Route("/iframe/", name="iframe_index")
    */
    public function iframeIndexAction()
    {
        return $this->render('AppBundle:Iframe:index.html.twig');
    }
}
