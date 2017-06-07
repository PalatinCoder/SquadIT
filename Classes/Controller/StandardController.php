<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use SquadIT\WebApp\Domain\Model\Event;

class StandardController extends AbstractUserAwareActionController
{
    /**
     * @return void
     */
    public function indexAction()
    {
        /** @var array<Event> $upcomingEvents */
        $upcomingEvents = array();

        foreach ($this->user->getSquads() as $squad) {
            foreach ($squad->getEvents() as $event) {
                if ($event->getStartDate() > new \DateTime) {
                    $upcomingEvents[] = $event;
                }
            }
        }

        usort($upcomingEvents, function (Event $a, Event $b) {
            $ad = $a->getStartDate();
            $bd = $b->getStartDate();

            if ($ad == $bd) {
                return 0;
            }
            return $ad < $bd ? -1 : 1;
        });

        $this->view->assign('upcomingevents', array_slice($upcomingEvents, 0, 5));
    }
}
