<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\FirmwareType;
use AppBundle\Entity\FirmwareConfig;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    /**
     * @Route("/upload")
     */
    public function showAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $firmware = new FirmwareConfig();
        $user = $this->getUser();
        $firmware->setOwner($user?$user->getId():0);
        $firmware->setUniqueUrl(base_convert(microtime(false), 10, 36));
        $form = $this->createForm(FirmwareType::class, $firmware);
        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($firmware);
        if ($form->isSubmitted() && $form->isValid() && count($errors) == 0) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($firmware);
            $entityManager->flush();
            $messages = ["Firmware uploaded!"];
            return $this->forward('AppBundle:Dashboard:show', array('messages' => $messages));
        }
        return $this->render('AppBundle:Upload:index.html.twig',
            array('form' => $form->createView(), 'errors' => $errors));
    }
}
