<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrackController extends Controller
{
    public function indexAction()
    {
        $tracks = $this->get('app.repository.track')->findAll();

        return $this->render('AppBundle:Track:index.html.twig', array(
            'tracks' => $tracks
        ));
    }

    public function showAction($_format, $id)
    {
        $track = $this->get('app.repository.track')->find($id);

        if (null === $track) {
            throw $this->createNotFoundException();
        }

        if ('json' === $_format) {
            return new JsonResponse($track);
        }

        return $this->render('AppBundle:Track:show.html.twig', array(
            'track' => $track
        ));
    }
}
