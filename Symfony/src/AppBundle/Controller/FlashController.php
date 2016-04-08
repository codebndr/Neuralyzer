<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Log;

class FlashController extends Controller
{
    /**
     * @Route("/flash/{$uniqueUrl}", name="flash")
     */
    public function showAction($uniqueUrl)
    {
        $firmware = $this->getDoctrine()
            ->getRepository('AppBundle:FirmwareConfig')
            ->findByUniqueUrl($uniqueUrl);
        $decodedFirmware = json_decode($firmware[0]->getBoardUploadConfig());
        $entityManager = $this->getDoctrine()->getManager();
        $user = $firmware[0]->getOwner();
        $session = new Session();
        $log = new Log();
        $externalIp = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
        $log->setOwner($user)->setLogType(100)->setReadableLogType("Flash Page Viewed!")->setBrowser(get_browser(null,true)["browser_name_pattern"])->setHasPreviousSession(false)->setIp($externalIp)->setTimestamp(time())->setMetadata(["Logged from FlashController:showAction"])->setSession($session->getId());
        $entityManager->persist($log);
        $entityManager->flush();
        return $this->render('AppBundle:Flash:index.html.twig', array('ipb'=>$externalIp,'ipa'=>$log->getIp(),'firmware' => $firmware[0], 'boardName' => $decodedFirmware->{'name'}, 'boardUpload'=>$decodedFirmware->upload, 'boardBuild'=>$decodedFirmware->build));
    }
}
