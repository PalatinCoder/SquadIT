<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Doctrine\PersistenceManager;
use TYPO3\Flow\Security\Context;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\AccountRepository;
use TYPO3\Flow\Security\Policy\PolicyService;
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
     * @var PolicyService
     */
    protected $policyService;

    /**
     * @Flow\Inject
     * @var PersistenceManager
     */
    protected $persistenceManager;

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
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * @Flow\Inject
     * @var Context
     */
    protected $securityContext;

    /**
     * Holds the currently logged in user
     *
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
        $this->view->assign('user_email', $this->securityContext->getAccount()->getAccountIdentifier());
    }

    /**
     * @return void
     */
    public function initializeCreateAction()
    {
        $propertyConfiguration = $this->arguments->getArgument('newSquad')->getPropertyMappingConfiguration();
        $propertyConfiguration->forProperty('members')->allowAllProperties();
    }

    /**
     * @param Squad $newSquad
     * @return void
     */
    public function createAction(Squad $newSquad)
    {
        /** @var \TYPO3\Flow\Security\Policy\Role */
        $role = $this->policyService->getRole('SquadIT.WebApp:TeamCaptain');
        /** @var Account $account */
        $account = $this->securityContext->getAccount();
        $account->addRole($role);
        $this->accountRepository->update($account);
        $this->persistenceManager->persistAll();

        $this->squadRepository->add($newSquad);
        $this->addFlashMessage('Created a new squad.');
        $this->redirect('show', null, null, array('squad' => $newSquad));
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
        $this->addFlashMessage('Updated %s', null, null, array($squad->getName()));
        $this->redirect('show', null, null, array('squad' => $squad));
    }

    /**
     * @param Squad $squad
     * @return void
     */
    public function deleteAction(Squad $squad)
    {
        $this->squadRepository->remove($squad);
        $this->addFlashMessage('Deleted the squad.');
        $this->redirect('index', 'Standard');
    }
}
