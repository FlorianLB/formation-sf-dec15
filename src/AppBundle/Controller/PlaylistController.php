<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlaylistController extends Controller
{
    public function indexAction()
    {
        $playlists = $this->get('app.repository.playlist')->findAll();

        return $this->render('AppBundle:Playlist:index.html.twig', array(
            'playlists' => $playlists
        ));
    }

    public function showAction($_format, $id)
    {
        $playlist = $this->get('app.repository.playlist')->find($id);

        if (null === $playlist) {
            throw $this->createNotFoundException();
        }

        $totalDuration = $this->get('app.playlist.duration_calculator')->calculate($id);

        if ('json' === $_format) {
            return new JsonResponse($playlist);
        }

        return $this->render('AppBundle:Playlist:show.html.twig', array(
            'playlist' => $playlist,
            'totalDuration' => $totalDuration
        ));
    }
}
