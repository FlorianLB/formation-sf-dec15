<?php

namespace Spotizer\Notification;

use AppBundle\Entity\Artist;

class ArtistNotifier
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    private $to;
    private $from;

    public function __construct(\Swift_Mailer $mailer, $from, $to)
    {
        $this->mailer = $mailer;
        $this->to = $to;
        $this->from = $from;
    }


    public function notifyNewArtist(Artist $artist)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setBody('Artist ' . $artist->getName() . 'created');

        $this->mailer->send($message);
    }
}