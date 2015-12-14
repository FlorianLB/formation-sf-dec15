<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrackController extends Controller
{
    public function indexAction()
    {
        $tracks = $this->getTracks();

        return $this->render('AppBundle:Track:index.html.twig', array(
            'tracks' => $tracks
        ));
    }

    public function showAction($_format, $id)
    {
        $track = null;
        foreach($this->getTracks() as $t) {
            if ((int) $id === $t['id']) {
                $track = $t;
            }
        }

        if (null === $track) {
            throw $this->createNotFoundException();
        }

        if ('json' === $_format) {
            return new JsonResponse(track);
        }

        return $this->render('AppBundle:Track:show.html.twig', array(
            'track' => $track
        ));
    }

    protected function getTracks()
    {
        return array(
            array(
                'id'     => 123,
                'title'  => 'Everlong',
                'artist' => 1,
            ),
            array(
                'id'     => 456,
                'title'  => 'Mardy Bum',
                'artist' => 2,
            )
        );
    }
}
