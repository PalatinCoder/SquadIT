<?php
namespace SquadIT\WebApp\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\Context;
use Neos\Flow\Security\AccountRepository;
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
     * @param \Neos\Flow\Mvc\View\ViewInterface $view
     * @return void
     */
    public function initializeView(\Neos\Flow\Mvc\View\ViewInterface $view)
    {
        $this->user = $this->userRepository->findOneByAccount($this->securityContext->getAccount());
        if ($this->user === null) {
            return;
        }
        $view->assign('user', $this->user);
    }
}
