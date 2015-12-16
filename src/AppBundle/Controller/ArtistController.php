<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Artist;
use AppBundle\Form\Type\ArtistType;
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

    public function newAction(Request $request)
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('artists_index'));
        }

        return $this->render('AppBundle:Artist:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Seconde manière de récuperer l'Artist (ParamConverter)
    public function updateAction(Request $request, Artist $artist)
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('artists_show', ['id' => $artist->getId()]));
        }

        return $this->render('AppBundle:Artist:update.html.twig', [
            'artist' => $artist,
            'form' => $form->createView()
        ]);
    }
}
