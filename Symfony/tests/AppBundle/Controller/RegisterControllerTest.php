<?php
namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
	public function testRegisterProcess()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/register');

		$form = $crawler->selectButton('register-button')->form();

		$crawler = $client->submit($form);
		$this->assertNotContains("The user account has been registered.", $crawler->text());

		$form['registration[username]'] = 'alexyao999';
		$crawler = $client->submit($form);
		$this->assertNotContains("The user account has been registered.", $crawler->text());

		$form['registration[email]'] = 'alexyao999@gmail.com';
		$form['registration[password][first]'] = 'qwerty';
		$form['registration[password][second]'] = 'qwerty';

		$crawler = $client->submit($form);
		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$crawler = $client->submit($form);
		$this->assertEquals(500, $client->getResponse()->getStatusCode());
		$this->assertContains("Duplicate entry 'alexyao999'", $crawler->text());
	}
}
