<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FlashIframeController extends Controller
{
    /**
     * @Route("/flash/iframe/", name="iframe_index")
     */
    public function iframeIndexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('AppBundle:FlashIframe:index.html.twig');
    }
}
