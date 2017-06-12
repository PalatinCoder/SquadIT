<?php
namespace SquadIT\WebApp\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Security\Context as SecurityContext;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;
use SquadIT\WebApp\Service\UserContext;

abstract class AbstractUserAwareActionController extends ActionController
{
    /**
     * @Flow\Inject
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @Flow\Inject
     * @var UserContext
     */
    protected $userContext;

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
        $this->user = $this->userContext->getUser();
        if ($this->user === null) {
            return;
        }
        $view->assign('user', $this->user);
        $view->assign('currentControllerName', $this->request->getControllerName());
    }
}
