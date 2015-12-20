<?php

namespace AppBundle\EventListener;

use AppBundle\Event\ArtistEvent;
use Spotizer\Notification\ArtistNotifier;
use Symfony\Component\EventDispatcher\Event;

class ArtistListener
{
    /**
     * @var ArtistNotifier
     */
    private $notifier;

    /**
     * ArtistListener constructor.
     * @param ArtistNotifier $notifier
     */
    public function __construct(ArtistNotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function onArtistCreated(ArtistEvent $event)
    {
        $this->notifier->notifyNewArtist($event->getArtist());
    }
}