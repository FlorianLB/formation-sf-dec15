<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Playlist;
use AppBundle\Entity\Track;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSpotifier implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $acousticPL = new Playlist();
        $acousticPL->setTitle('Acoustic');
        $manager->persist($acousticPL);

        $resPL = new Playlist();
        $resPL->setTitle('Rock en Seine 2011');
        $manager->persist($resPL);

        $fooFigthers = new Artist();
        $fooFigthers->setName('Foo Figthers');
        $fooFigthers->setGenre('alternative rock');
        $fooFigthers->setType(Artist::TYPE_BAND);
        $fooFigthers->setPicture('http://rockmetalmag.fr/wp-content/uploads/2014/05/foo_fighters_52847.jpg');
        $manager->persist($fooFigthers);

        $track = new Track();
        $track->setTitle('Everlong');
        $track->setArtist($fooFigthers);
        $track->setDuration(287);
        $manager->persist($track);
        $resPL->addTrack($track);

        $track = new Track();
        $track->setTitle('Best of You');
        $track->setArtist($fooFigthers);
        $track->setDuration(308);
        $manager->persist($track);
        $resPL->addTrack($track);

        $track = new Track();
        $track->setTitle('Everlong - Acoustic version');
        $track->setArtist($fooFigthers);
        $track->setDuration(308);
        $manager->persist($track);
        $acousticPL->addTrack($track);


        $arcticMonkeys = new Artist();
        $arcticMonkeys->setName('Arctic Monkeys');
        $arcticMonkeys->setGenre('indie rock');
        $arcticMonkeys->setType(Artist::TYPE_BAND);
        $arcticMonkeys->setPicture('http://www.lesinrocks.com/wp-content/thumbnails/uploads/2014/02/amonk-tt-width-604-height-380-lazyload-0-crop-0-bgcolor-000000.jpg');
        $manager->persist($arcticMonkeys);

        $track = new Track();
        $track->setTitle('Mardy Bum');
        $track->setArtist($arcticMonkeys);
        $track->setDuration(256);
        $manager->persist($track);
        $resPL->addTrack($track);

        $track = new Track();
        $track->setTitle('When the sun goes down');
        $track->setArtist($arcticMonkeys);
        $track->setDuration(320);
        $manager->persist($track);


        $redHot = new Artist();
        $redHot->setName('Red Hot Chili Peppers');
        $redHot->setGenre('californian rock');
        $redHot->setType(Artist::TYPE_BAND);
        $redHot->setPicture(' http://www.sensationrock.net/wp-content/uploads/2015/10/Red-Hot-Chili-Peppers_11506.jpg');
        $manager->persist($redHot);


        $manager->flush();
    }
}