<?php
namespace SquadIT\WebApp\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\Context;
use TYPO3\Flow\Security\AccountRepository;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;

abstract class AbstractUserAwareActionController extends ActionController
{

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
     * Holds the current user
     *
     * @var User
     */
    protected $user;

    /**
     * @param \TYPO3\Flow\Mvc\View\ViewInterface $view
     * @return void
     */
    public function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view)
    {
        $this->user = $this->userRepository->findOneByAccount($this->securityContext->getAccount());
        if ($this->user === null) {
            return;
        }
        $view->assign('user', $this->user);
    }
}
