<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\RegistrationType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($user);
        if ($form->isSubmitted() && $form->isValid() && count($errors) == 0) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password)->setSuccessfulFlashCount(0)->setTotalFlashCount(0)->setTier(0);
            try {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $token = new UsernamePasswordToken($user, null, 'login', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $messages = ["You have been registered!"];
                return $this->forward('AppBundle:Dashboard:show', array('messages' => $messages));
            } catch(\Exception $e){
                $errors = $e;
            }
        }

        return $this->render('AppBundle:Register:index.html.twig', array('form' => $form->createView(), 'errors' => $errors));
    }
}
