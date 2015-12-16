<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatsController extends Controller
{
    public function indexAction()
    {
        $tracksCountGroupByArtist = $this->get('app.stats.track_reporting')->getCountGroupByArtist(5);

        return $this->render('AppBundle:Stats:index.html.twig', [
            'tracksCountGroupByArtist' => $tracksCountGroupByArtist
        ]);
    }
}
