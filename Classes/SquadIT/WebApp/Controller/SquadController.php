<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use SquadIT\WebApp\Domain\Model\Squad;

class SquadController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \SquadIT\WebApp\Domain\Repository\SquadRepository
     */
    protected $squadRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('squads', $this->squadRepository->findAll());
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $squad
     * @return void
     */
    public function showAction(Squad $squad)
    {
        $this->view->assign('squad', $squad);
    }

    /**
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $newSquad
     * @return void
     */
    public function createAction(Squad $newSquad)
    {
        $this->squadRepository->add($newSquad);
        $this->addFlashMessage('Created a new squad.');
        $this->redirect('index');
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $squad
     * @return void
     */
    public function editAction(Squad $squad)
    {
        $this->view->assign('squad', $squad);
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $squad
     * @return void
     */
    public function updateAction(Squad $squad)
    {
        $this->squadRepository->update($squad);
        $this->addFlashMessage('Updated the squad.');
        $this->redirect('index');
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $squad
     * @return void
     */
    public function deleteAction(Squad $squad)
    {
        $this->squadRepository->remove($squad);
        $this->addFlashMessage('Deleted a squad.');
        $this->redirect('index');
    }

}
