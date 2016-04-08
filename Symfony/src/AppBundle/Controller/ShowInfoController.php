<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ShowInfoController extends Controller
{
    /**
     * @Route("/showinfo/{$firmwareid}", name="showinfo")
     */
    public function showAction($firmwareid)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $firmware = $this->getDoctrine()
            ->getRepository('AppBundle:FirmwareConfig')
            ->find($firmwareid);
        if ($usr->getId() !== $firmware->getOwner()) {
            throw new AccessDeniedException();
        }

        return $this->render('AppBundle:ShowInfo:index.html.twig', array('firmware' => $firmware));
    }
}
