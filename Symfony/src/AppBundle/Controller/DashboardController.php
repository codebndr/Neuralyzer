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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $firmwares = $this->getDoctrine()
            ->getRepository('AppBundle:FirmwareConfig')
            ->findByOwner($user->getId());
        $tier = $this->getDoctrine()
            ->getRepository('AppBundle:Tier')
            ->find($user->getTier());

        return $this->render(
            'AppBundle:Dashboard:index.html.twig',
            array('user' => $user, 'firmwares' => $firmwares, 'tier' => $tier)
        );
    }
}
