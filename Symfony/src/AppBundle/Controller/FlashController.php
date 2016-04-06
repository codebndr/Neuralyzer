<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        return $this->render('AppBundle:Flash:index.html.twig', array('firmware' => $firmware[0], 'boardName' => $decodedFirmware->{'name'}, 'boardUpload'=>$decodedFirmware->upload, 'boardBuild'=>$decodedFirmware->build));
    }
}
