<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\ActionRequest;
use TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController;

class AuthenticationController extends AbstractAuthenticationController
{

    /**
     * Logs all active tokens out and redirects the user to the login form
     *
     * @return void
     */
    public function logoutAction()
    {
        parent::logoutAction();
        $this->addFlashMessage('Logout successful');
        $this->redirect('login');
    }

    /**
     * Will be triggered upon successful authentication
     *
     * @param ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
     * @return string
     */
    protected function onAuthenticationSuccess(ActionRequest $originalRequest = null)
    {
        if ($originalRequest !== null) {
            $this->redirectToRequest($originalRequest);
        }
        $this->redirect('index', 'Standard');
    }

    /**
     * Is called if authentication failed.
     *
     * @param \TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception The exception thrown while the authentication process
     * @return void
     */
    protected function onAuthenticationFailure(\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception = null)
    {
        $this->flashMessageContainer->addMessage(new \TYPO3\Flow\Error\Error('Authentication failed!', ($exception === null ? 1347016771 : $exception->getCode())));
        $this->redirect('login');
    }
}
