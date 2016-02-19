<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FlashControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/flash');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Upload .hex file', $crawler->filter('h2')->text());
    }
}
