<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Track;
use AppBundle\Form\Type\TrackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
            'track'       => $track,
            'delete_form' => $this->createDeleteForm($track)->createView()
        ));
    }

    public function newAction(Request $request)
    {
        $track = new Track();
        $form = $this->createForm(TrackType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->persist($track);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('tracks_index'));
        }

        return $this->render('AppBundle:Track:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction(Request $request, $id)
    {
        $track = $this->get('app.repository.track')->find($id);

        if (null === $track) {
            throw $this->createNotFoundException();
        }

        $form = $this->createDeleteForm($track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->get('doctrine.orm.entity_manager');
            $entityManager->remove($track);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tracks_index');
    }

    private function createDeleteForm(Track $track)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tracks_delete', array('id' => $track->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
