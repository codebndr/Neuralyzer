<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Log;

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
        $session = new Session();
        $log = new Log();
        $externalIp = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
        $log->setOwner($owner)->setLogType(201)->setReadableLogType("Flash Failed!")->setBrowser(get_browser(null,true)["browser_name_pattern"])->setHasPreviousSession(false)->setIp($externalIp)->setTimestamp(time())->setMetadata(["Logged from UpdateFlashCountController:updateAction"])->setSession($session->getId());
        if ($data["result"] == "Upload successful!") {
            $user->setSuccessfulFlashCount($user->getSuccessfulFlashCount() + 1);
            $log->setLogType(202)->setReadableLogType("Flash Successful!");
        }
        $entityManager->persist($log);
        $entityManager->flush();
        return new Response();
    }
}
