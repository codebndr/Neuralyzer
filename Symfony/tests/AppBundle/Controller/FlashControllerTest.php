<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FlashControllerTest extends WebTestCase
{
    public function testFlashHeader()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flash');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Upload .hex file', $crawler->filter('h2')->text());
    }

    public function testFlashConfig()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flash');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Select Board', $crawler->filter('h2')->eq(2)->text());
    }

    public function testFlashButtonName()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flash');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Select Button Name', $crawler->filter('h2')->eq(5)->text());
    }
}
