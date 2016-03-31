<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testUploadPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Upload .hex file', $crawler->filter('h2')->text());
        $this->assertContains('Next', $crawler->filter('button#nextButton')->text());
        $this->assertContains('Submit', $crawler->filter('button#submitButton')->text());
    }
}
