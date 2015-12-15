<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{
    public function indexAction()
    {
        $artists = $this->get('app.repository.artist')->findAll();

        return $this->render('AppBundle:Artist:index.html.twig', array(
            'artists' => $artists
        ));
    }

    public function showAction($_format, $id)
    {
        $artist = $this->get('app.repository.artist')->find($id);

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
}
