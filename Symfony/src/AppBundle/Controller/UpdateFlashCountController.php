<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateFlashCountController extends Controller
{
    /**
     * @Route("/update_flash_count/{owner}", name="update_flash_count")
     */
    public function updateAction(Request $request, $owner)
    {
        $data = $request->request->all();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('AppBundle:User')->find($owner);
        $user->setTotalFlashCount($user->getTotalFlashCount() + 1);
        if ($data["result"] == "Upload successful!") {
            $user->setSuccessfulFlashCount($user->getSuccessfulFlashCount() + 1);
        }
        $entityManager->flush();
        return new Response();
    }
}
