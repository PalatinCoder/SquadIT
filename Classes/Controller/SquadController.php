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
use SquadIT\WebApp\Service\ImageProcessingService;

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
     * @Flow\Inject
     * @var ImageProcessingService
     */
    protected $imageProcessingService;

    /**
     * @Flow\Inject
     * @var \Neos\Flow\ResourceManagement\ResourceManager
     */
    protected $resourceManager;

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
        /** @var PersistentResource */
        $profilepicture = $newSquad->getProfilepicture();

        if ($profilepicture) {
            // delete the uploaded profile picture
            $this->resourceManager->deleteResource($profilepicture);
            /** @var PersistentResource */
            $processedImage = $this->imageProcessingService->processProfilepicture($profilepicture);
            // set the processed one
            $newSquad->setProfilepicture($processedImage);
        }


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
        // update and persist so that the resource is actually imported thus accessible to the processing service
        $this->squadRepository->update($squad);
        $this->persistenceManager->persistAll();

        /** @var PersistentResource */
        $processedImageResource = $this->imageProcessingService->processProfilepicture($squad->getProfilepicture());

        $squad->setProfilepicture($processedImageResource);  // set the processed picture, uploaded one will be deleted
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
        if ($squad->getProfilepicture() != null) {
            $this->resourceManager->deleteResource($squad->getProfilepicture());
        }

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
         $squad->setLeader($user);
         $this->squadRepository->update($squad);

         $this->addFlashMessage('%s is now team captain of %s', null, null, array($user->getFullName(), $squad->getName()));
         $this->redirect('show', null, null, array('squad' => $squad));
     }
}
