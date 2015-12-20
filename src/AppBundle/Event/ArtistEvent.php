<?php

namespace AppBundle\Event;

use AppBundle\Entity\Artist;
use Symfony\Component\EventDispatcher\Event;

class ArtistEvent extends Event
{
    /**
     * @var Artist
     */
    private $artist;

    /**
     * ArtistEvent constructor.
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }


}