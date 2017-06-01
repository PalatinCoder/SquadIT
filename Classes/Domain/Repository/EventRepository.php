<?php
namespace SquadIT\WebApp\Domain\Repository;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use SquadIT\WebApp\Domain\Model\Squad;

/**
 * @Flow\Scope("singleton")
 */
class EventRepository extends Repository
{
    /**
     * Finds all events belonging to a particular squad
     *
     * @param Squad $squad
     * @return \Neos\Flow\Persistence\QueryResultInterface
     */
    public function findBySquad(Squad $squad)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('squad', $squad)
            )->setOrderings(array(
                'startDate' => \Neos\Flow\Persistence\QueryInterface::ORDER_DESCENDING
            ))->execute();
    }
}
