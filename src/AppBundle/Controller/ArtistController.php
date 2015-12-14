<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{
    public function indexAction()
    {
        $tracks = $this->getArtists();

        return $this->render('AppBundle:Artist:index.html.twig', array(
            'artists' => $tracks
        ));
    }

    public function showAction($_format, $id)
    {
        $artist = null;
        foreach($this->getArtists() as $a) {
            if ((int) $id === $a['id']) {
                $artist = $a;
            }
        }

        if (null === $artist) {
            throw $this->createNotFoundException();
        }

        if ('json' === $_format) {
            return new JsonResponse($artist);
        }

        return $this->render('AppBundle:Artist:show.html.twig', array(
            'artist' => $artist
        ));
    }

    protected function getArtists()
    {
        return array(
            array(
                'id'    => 1,
                'name'  => 'Foo fighters',
                'type'  => 'band', // solo
                'picture' => 'http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg',
                'genre' => 'rock',
            )
        );
    }
}
