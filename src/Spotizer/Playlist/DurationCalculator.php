<?php

namespace Spotizer\Playlist;

use AppBundle\Repository\TrackRepository;

class DurationCalculator
{
    /**
     * @var TrackRepository
     */
    private $trackRepository;

    public function __construct(TrackRepository $trackRepository)
    {
        $this->trackRepository = $trackRepository;
    }

    public function calculate($playlistId)
    {
        $tracks = $this->trackRepository->findByPlaylistId($playlistId);

        $duration = 0;
        foreach ($tracks as $track) {
            $duration += $track->getDuration();
        }

        return $duration;
    }
}