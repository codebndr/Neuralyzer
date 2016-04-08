<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateTierController extends Controller
{
    /**
     * @Route("/update_tier/{owner}", name="update_tier")
     */
    public function updateAction(Request $request, $owner)
    {
        $data = $request->request->all();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('AppBundle:User')->find($owner);
        if ($data["tier"] !== null && $data["tier"] > 0) {
            $user->setTier($data["tier"]);
        }
        $entityManager->flush();
        return new Response();
    }
}
