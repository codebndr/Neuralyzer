<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRegisterProcess()
    {
        $client = static::createClient(
            array(),
            array(
                'HTTP_HOST' => '127.0.0.1:8080',
            ));
        $crawler = $client->request('GET', '/register');
        var_dump($crawler);
        $form = $crawler->selectButton('register-button')->form();
        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/&#039;username&#039; cannot be null/',
            $client->getResponse()->getContent()
        );
        $form['registration[username]'] = 'alexyao999';
        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/&#039;email&#039; cannot be null/',
            $client->getResponse()->getContent()
        );
        $form['registration[email]'] = 'alexyao999@gmail.com';
        $form['registration[password][first]'] = 'qwerty';
        $form['registration[password][second]'] = 'qwerty';
        $form['registration[tier]'] = 3;
        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/duplicate/',
            $client->getResponse()->getContent()
        );
    }
}
