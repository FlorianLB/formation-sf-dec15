<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;

class TrackRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByPlaylistId($playListId)
    {
        $qb = $this->createQueryBuilder('t')
            ->join('t.playlists', 'p')
            ->where('p.id = :id')
                ->setParameter('id', $playListId);

        return $qb->getQuery()->getResult();
    }

    public function findAllOrderedByTitleQueryBuilder()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.title', 'DESC');
    }
}
