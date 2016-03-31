<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function showAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $firmwares = $this->getDoctrine()
            ->getRepository('AppBundle:FirmwareConfig')
            ->findByOwner($usr->getId());
        $tier = $this->getDoctrine()
            ->getRepository('AppBundle:Tier')
            ->find($usr->getTier());

        return $this->render('AppBundle:Dashboard:index.html.twig',
            array('user' => $usr, 'firmwares' => $firmwares, 'tier' => $tier));
    }
}
