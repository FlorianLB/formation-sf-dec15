<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatsController extends Controller
{
    public function indexAction($_format)
    {
        $tracksCountGroupByArtist = $this->get('app.stats.track_reporting')->getCountGroupByArtist(5);

        if ('json' === $_format) {
            return new JsonResponse($tracksCountGroupByArtist);
        }

        return $this->render('AppBundle:Stats:index.html.twig', [
            'tracksCountGroupByArtist' => $tracksCountGroupByArtist
        ]);
    }
}
