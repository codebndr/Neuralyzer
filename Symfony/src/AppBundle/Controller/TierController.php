<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TierController extends Controller
{
    /**
     * @Route("/tier", name="tier")
     */
    public function showAction()
    {
        $tiers = $this->getDoctrine()
            ->getRepository('AppBundle:Tier')
            ->findAll();

        return $this->render('AppBundle:Tier:index.html.twig', array('tiers' => $tiers));
    }
}
