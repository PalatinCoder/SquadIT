<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use SquadIT\WebApp\Domain\Model\Event;
use SquadIT\WebApp\Domain\Model\Squad;

class EventController extends AbstractUserAwareActionController
{

    /**
     * @Flow\Inject
     * @var \SquadIT\WebApp\Domain\Repository\EventRepository
     */
    protected $eventRepository;

    /**
     * Show the events of the specified squad
     * @param Squad $squad
     * @return void
     */
    public function indexAction(Squad $squad)
    {
        $this->view->assign('events', $this->eventRepository->findBySquad($squad));
        $this->view->assign('squad', $squad);
    }

    /**
     * @param Event $event
     * @return void
     */
    public function showAction(Event $event)
    {
        $this->view->assign('event', $event);
        $this->view->assign('squad', $event->getSquad());
    }

    /**
     * @return void
     */
    public function newAction(Squad $squad)
    {
        $this->view->assign('squad', $squad);
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Event $newEvent
     * @return void
     */
    public function createAction(Event $newEvent)
    {
        $this->eventRepository->add($newEvent);
        $this->addFlashMessage(sprintf('Created event "%s" for "%s"', $newEvent->getTitle(), $newEvent->getSquad()->getName()));
        $this->redirect('index', null, null, array("squad" => $newEvent->getSquad()));
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Event $event
     * @return void
     */
    public function editAction(Event $event)
    {
        $this->view->assign('event', $event);
        $this->view->assign('squad', $event->getSquad());
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Event $event
     * @return void
     */
    public function updateAction(Event $event)
    {
        $this->eventRepository->update($event);
        $this->addFlashMessage(sprintf('Updated the event "%s"', $event->getTitle()));
        $this->redirect('index', null, null, array("squad" => $event->getSquad()));
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Event $event
     * @return void
     */
    public function deleteAction(Event $event)
    {
        $this->eventRepository->remove($event);
        $this->addFlashMessage(sprintf('Deleted the event "%s"', $event->getTitle()));
        $this->redirect('index', null, null, array("squad" => $event->getSquad()));
    }
}
