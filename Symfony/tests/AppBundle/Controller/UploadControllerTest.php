<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UploadControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testFlashPage()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/upload');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Upload .hex file', $crawler->filter('h2')->text());
        $this->assertContains('Next', $crawler->filter('button#nextButton')->text());
        $this->assertContains('Save Firmware Configurations', $crawler->filter('button#submitButton')->text());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');
        $firewall = 'login';
        $token = new UsernamePasswordToken('alexyao99', 'qwerty', $firewall, array('ROLE_USER'));
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();
        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
