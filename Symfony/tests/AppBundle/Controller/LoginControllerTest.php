<?php
namespace Tests\Appbundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use AppBundle\Entity\User;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testSecuredHello()
    {
        $this->logIn();

        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Logout")')->count());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'login';
        $token = new UsernamePasswordToken('alexyao99', 'qwerty', $firewall, array('ROLE_USER'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}