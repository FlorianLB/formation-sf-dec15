<?php

namespace Spotizer\Stats;

use Doctrine\ORM\EntityManager;

class TrackReporting
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getCountGroupByArtist($limit = 10)
    {
        $query = $this->entityManager->createQuery('
            SELECT COUNT(t) AS nb, a.name AS name, a.id AS id
            FROM AppBundle:Artist a
            LEFT JOIN a.tracks t
            GROUP BY a.id
        ')->setMaxResults($limit);

        return $query->getResult();
    }

}