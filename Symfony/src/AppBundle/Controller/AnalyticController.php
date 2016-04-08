<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;

class AnalyticController extends Controller
{
    /**
     * @Route("/analytic", name="analytic")
     */
    public function showAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $logs = $this->getDoctrine()
            ->getRepository('AppBundle:Log')
            ->findByOwner($user->getId());
        $punchCardArray = [];
        $daysInWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $csvOpen = fopen("punchCardArray.csv", "w");
        fwrite($csvOpen, ",0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23" . PHP_EOL);
        foreach ($logs as $log) {
            $epoch = intval($log->getTimestamp());
            $datetime = new \DateTime("@$epoch");
            $day = $datetime->format('N');
            $hour = $datetime->format('G');
            if (isset($punchCardArray[$day][$hour])) {
                $punchCardArray[$day][$hour]++;
                continue;
            }
            $punchCardArray[$day][$hour] = 1;
        }
        for ($days = 0; $days < 7; $days++) {
            fwrite($csvOpen, $daysInWeek[$days]);
            for ($hours = 0; $hours < 24; $hours++) {
                if (isset($punchCardArray[$days][$hours])) {
                    fwrite($csvOpen, "," . $punchCardArray[$days][$hours]);
                    continue;
                }
                fwrite($csvOpen, ",0");

            }
            fwrite($csvOpen, PHP_EOL);
        }
        fclose($csvOpen);
        return $this->render('AppBundle:Analytic:index.html.twig',
            array('user' => $user, 'logs' => $logs));
    }
}
