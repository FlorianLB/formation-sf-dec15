<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\Playlist;
use Spotizer\Playlist\DurationCalculator;

class AppExtension extends \Twig_Extension
{
    /**
     * @var DurationCalculator
     */
    private $durationCalculator;

    public function __construct(DurationCalculator $durationCalculator)
    {
        $this->durationCalculator = $durationCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('playlist_duration', array($this, 'playlistDuration'))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('sec_to_min', array($this, 'secToMin'))
        );
    }

    public function secToMin($timeInSeconds)
    {
        $minutes = abs($timeInSeconds / 60);
        $seconds = $timeInSeconds % 60;

        return sprintf('%d:%2$02d', $minutes, $seconds);
    }


    public function playlistDuration(Playlist $playlist)
    {
        return $this->durationCalculator->calculate($playlist->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_extension';
    }
}
