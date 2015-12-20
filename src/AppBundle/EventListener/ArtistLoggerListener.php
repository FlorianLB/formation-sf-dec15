<?php

namespace AppBundle\EventListener;

use AppBundle\Event\ArtistEvent;
use Psr\Log\LoggerInterface;

class ArtistLoggerListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onArtistCreated(ArtistEvent $event)
    {
        $this->logger->info(sprintf("Artist '%s' created", $event->getArtist()->getName()));
    }
}