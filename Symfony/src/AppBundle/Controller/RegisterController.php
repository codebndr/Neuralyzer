<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\RegistrationType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        $session = $this->get('session');
        $tiers = $this->getDoctrine()
            ->getRepository('AppBundle:Tier')
            ->findAll();
        $session->set('tiers', $tiers);
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password)->setSuccessfulFlashCount(0)->setFailedFlashCount(0)->setTotalFlashCount(0);
            $doc = $this->getDoctrine()->getManager();
            $doc->persist($user);
            $doc->flush();
            $token = new UsernamePasswordToken($user, null, 'login', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            ?>
            <script type="text/javascript">
                alert("The user account has been registered.");
                window.location.href = "../";
            </script>
            <?php
        }

        return $this->render('AppBundle:Register:index.html.twig', array('form' => $form->createView()));
    }
}
