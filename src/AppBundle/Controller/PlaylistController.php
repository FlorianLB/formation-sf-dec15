<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Playlist;
use AppBundle\Form\Type\PlaylistType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

    public function newAction(Request $request)
    {
        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($playlist);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('artists_index'));
        }

        return $this->render('AppBundle:Playlist:new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
