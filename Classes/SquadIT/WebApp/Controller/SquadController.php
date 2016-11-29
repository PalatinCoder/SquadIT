<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Context;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Mvc\Controller\ActionController;
use SquadIT\WebApp\Domain\Model\Squad;
use SquadIT\WebApp\Domain\Repository\SquadRepository;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;

class SquadController extends ActionController
{

    /**
     * @Flow\Inject
     * @var SquadRepository
     */
    protected $squadRepository;

    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @Flow\Inject
     * @var Context
     */
    protected $securityContext;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param ViewInterface $view
     * @return void
     */
    public function initializeView(ViewInterface $view)
    {
        $this->user = $this->userRepository->findOneByAccount($this->securityContext->getAccount());
        if ($this->user === null) {
            return;
        }
        $view->assign('user_firstname', $this->user->getFirstname());
        $view->assign('user_initials', substr($this->user->getFirstname(), 0, 1) . substr($this->user->getLastname(), 0, 1));
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('squads', $this->squadRepository->findAll());
    }

    /**
     * @param Squad $squad
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
     * @param Squad $newSquad
     * @return void
     */
    public function createAction(Squad $newSquad)
    {
        $this->squadRepository->add($newSquad);
        $this->addFlashMessage('Created a new squad.');
        $this->redirect('index');
    }

    /**
     * @param Squad $squad
     * @return void
     */
    public function editAction(Squad $squad)
    {
        $this->view->assign('squad', $squad);
    }

    /**
     * @param Squad $squad
     * @return void
     */
    public function updateAction(Squad $squad)
    {
        $this->squadRepository->update($squad);
        $this->addFlashMessage('Updated the squad.');
        $this->redirect('index');
    }

    /**
     * @param Squad $squad
     * @return void
     */
    public function deleteAction(Squad $squad)
    {
        $this->squadRepository->remove($squad);
        $this->addFlashMessage('Deleted a squad.');
        $this->redirect('index');
    }
}
