<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlaylistControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/playlists');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShow404()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/playlists/00');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
