<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\AccountRepository;
use TYPO3\Flow\Security\AccountFactory;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;

class UserController extends \TYPO3\Flow\Mvc\Controller\ActionController
{

    /**
     * @Flow\Inject
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * @Flow\Inject
     * @var AccountFactory
     */
    protected $accountFactory;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\Context
     */
    protected $securityContext;

    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @Flow\Inject
     * @var User
     */
    protected $user;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }

    /**
     * Shows a registration form
     *
     * @return void
     */
    public function registerAction()
    {
    }

    /**
     * Create a User and an account for login
     *
     * @param string $firstname
     * @Flow\Validate(argumentName="firstname", type="NotEmpty")
     * @param string $lastname
     * @Flow\Validate(argumentName="firstname", type="NotEmpty")
     * @param string $email
     * @Flow\Validate(argumentName="firstname", type="NotEmpty")
     * @Flow\Validate(argumentName="email", type="EmailAddress")
     * @param string $password
     * @Flow\Validate(argumentName="firstname", type="NotEmpty")
     * @param string $passwordRepeat
     * @Flow\Validate(argumentName="firstname", type="NotEmpty")
     * @return void
     */
    public function createAction($firstname, $lastname, $email, $password, $passwordRepeat)
    {
        if ($password !== $passwordRepeat) {
            $this->addFlashMessage('The entered passwords are not identical', 'Error', Message::SEVERITY_ERROR);
            $this->redirect('register');
        }

        /** @var Account $account */
        $account = $this->accountFactory->createAccountWithPassword($email, $password);
        $this->accountRepository->add($account);

        $user = new User($firstname, $lastname, $account);
        $this->userRepository->add($user);

        /*
         * Perform login for the created account
         */

        /** @var \TYPO3\Flow\Security\Authentication\Token\UsernamePassword */
        $authenticationTokens = $this->securityContext->getAuthenticationTokensOfType('TYPO3\Flow\Security\Authentication\Token\UsernamePassword');
        if (count($authenticationTokens) === 1) {
            $authenticationTokens[0]->setAccount($account);
            $authenticationTokens[0]->setAuthenticationStatus(\TYPO3\Flow\Security\Authentication\TokenInterface::AUTHENTICATION_SUCCESSFUL);
        }

        $this->addFlashMessage('Registration successful');
        $this->redirect('index', 'standard');
    }
}
