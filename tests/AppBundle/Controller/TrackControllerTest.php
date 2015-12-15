<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tracks');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShow404()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tracks/00');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
