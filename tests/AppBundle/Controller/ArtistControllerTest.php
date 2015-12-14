<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtistControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/artists');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/artists/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShow404()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/artists/2');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
