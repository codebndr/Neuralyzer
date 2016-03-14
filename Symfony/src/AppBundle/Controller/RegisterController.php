<?php
namespace AppBundle\Controller;

use AppBundle\Form\RegistrationType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setSuccessfulFlashCount(0);
            $user->setFailedFlashCount(0);
            $user->setTotalFlashCount(0);
            $user->setTier(0);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            ?>
            <script type="text/javascript">
                alert("The user account has been registered.");
                window.location.href = "../"
            </script>
            <?php

            return $this->redirectToRoute('/');
        }

        return $this->render(
            'AppBundle:Register:index.html.twig',
            array('form' => $form->createView())
        );
    }
}