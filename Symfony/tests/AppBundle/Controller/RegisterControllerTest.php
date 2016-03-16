<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRegisterNoUsername()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('register-button')->form();

        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/&#039;username&#039; cannot be null/',
            $client->getResponse()->getContent()
        );
    }

    public function testRegisterNoEmail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('register-button')->form();

        $form['registration[username]'] = 'alexyao999';

        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/&#039;email&#039; cannot be null/',
            $client->getResponse()->getContent()
        );
    }
    public function testRegisterSuccess()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('register-button')->form();

        $form['registration[username]'] = 'alexyao999';
        $form['registration[email]'] = 'alexyao999@gmail.com';
        $form['registration[password][first]'] = 'qwerty';
        $form['registration[password][second]'] = 'qwerty';

        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testRegisterDuplicate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('register-button')->form();

        $form['registration[username]'] = 'alexyao999';
        $form['registration[email]'] = 'alexyao999@gmail.com';
        $form['registration[password][first]'] = 'qwerty';
        $form['registration[password][second]'] = 'qwerty';

        $crawler = $client->submit($form);
        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/duplicate/',
            $client->getResponse()->getContent()
        );
    }
}
