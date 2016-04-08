<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadIframeController extends Controller
{
    /**
     * @Route("/upload/iframe/", name="upload_iframe")
     */
    public function iframeIndexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('AppBundle:UploadIframe:index.html.twig');
    }
}
