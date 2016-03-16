<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\RegistrationType;
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
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password)->setSuccessfulFlashCount(0)->setFailedFlashCount(0)->setTotalFlashCount(0)->setTier(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            ?>
            <script type="text/javascript">
                alert("The user account has been registered.");
                window.location.href = "../"
            </script>
            <?php
        }

        return $this->render('AppBundle:Register:index.html.twig', array('form' => $form->createView()));
    }
}
