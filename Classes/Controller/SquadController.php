<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Doctrine\PersistenceManager;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\Policy\PolicyService;
use SquadIT\WebApp\Domain\Model\Squad;
use SquadIT\WebApp\Domain\Repository\SquadRepository;
use SquadIT\WebApp\Domain\Model\User;

class SquadController extends AbstractUserAwareActionController
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
        /** @var \Neos\Flow\Security\Policy\Role */
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
     * @return void
     */
    public function initializeUpdateAction()
    {
        $propertyConfiguration = $this->arguments->getArgument('squad')->getPropertyMappingConfiguration();
        $propertyConfiguration->forProperty('members')->allowAllProperties();
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

    /**
     * Change the team captain of a squad
     *
     * @param User $user
     * @param Squad $squad
     * @return void
     */
     public function passLeadershipAction(User $user, Squad $squad)
     {
         /** @var \Neos\Flow\Policy\Role $role */
         $role = $this->policyService->getRole('SquadIT.WebApp:TeamCaptain');

         $this->user->getAccount()->removeRole($role);
         $user->getAccount()->addRole($role);

         $this->accountRepository->update($this->user->getAccount());
         $this->accountRepository->update($user->getAccount());

         $this->addFlashMessage('%s is now team captain of %s', null, null, array($user->getFullName(), $squad->getName()));
         $this->redirect('show', null, null, array('squad' => $squad));
     }
}
