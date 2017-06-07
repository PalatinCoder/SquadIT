<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Error\Messages\Message;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\AccountFactory;
use Neos\Flow\Security\Cryptography\HashService;
use SquadIT\WebApp\Domain\Model\User;

class UserController extends AbstractUserAwareActionController
{
    /**
     * @Flow\Inject
     * @var AccountFactory
     */
    protected $accountFactory;

    /**
     * @Flow\Inject
     * @var HashService
     */
    protected $hashService;

    /**
     * @var \Neos\Flow\ResourceManagement\ResourceManager
     * @Flow\Inject
     */
    protected $resourceManager;

    /**
     * @var \SquadIT\WebApp\Service\ImageProcessingService
     * @Flow\Inject
     */
    protected $imageProcessingService;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('account', $this->securityContext->getAccount());
    }

    /**
     * Shows a registration form
     * @param string $firstname Entered Firstname (if any)
     * @param string $lastname Entered Lastname (if any)
     * @param string $email Entered Email (if any)
     * @return void
     */
    public function registerAction($firstname = null, $lastname = null, $email = null)
    {
        $this->view->assign('firstname', $firstname);
        $this->view->assign('lastname', $lastname);
        $this->view->assign('email', $email);
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
            $this->redirect('register', null, null,
                array('firstname' => $firstname, 'lastname' => $lastname, 'email' =>  $email)
            );
        }

        if ($this->accountRepository->findOneByAccountIdentifier($email) !== null) {
            $this->addFlashMessage('The entered email is already registered', null, Message::SEVERITY_ERROR);
            $this->redirect('register', null, null,
                array('firstname' => $firstname, 'lastname' => $lastname)
            );
        }

        /** @var Account $account */
        $account = $this->accountFactory->createAccountWithPassword($email, $password);
        $this->accountRepository->add($account);

        $user = new User($firstname, $lastname, $account);
        $this->userRepository->add($user);

        /*
         * Perform login for the created account
         */

        /** @var \Neos\Flow\Security\Authentication\Token\UsernamePassword */
        $authenticationTokens = $this->securityContext->getAuthenticationTokensOfType('Neos\Flow\Security\Authentication\Token\UsernamePassword');
        if (count($authenticationTokens) === 1) {
            $authenticationTokens[0]->setAccount($account);
            $authenticationTokens[0]->setAuthenticationStatus(\Neos\Flow\Security\Authentication\TokenInterface::AUTHENTICATION_SUCCESSFUL);
        }

        $this->addFlashMessage('Registration successful');
        $this->redirect('index', 'standard');
    }

    /**
     * Update the user
     * (only the name as the image is processed in `changeProfilepictureAction`)
     *
     * @param User $user
     * @return void
     */
    public function updateAction($user)
    {
        $this->userRepository->update($user);

        $this->addFlashMessage('Updated your profile');
        $this->redirect('index');
    }

    /**
     * Change the profilepicture of the user
     *
     * @param \Neos\Flow\ResourceManagement\PersistentResource $image
     *
     * @return void
     */
    public function changeProfilepictureAction($image)
    {
        // delete the old profile picture
        if ($this->user->getProfilepicture() != null) {
            $this->resourceManager->deleteResource($this->user->getProfilepicture());
        }

        /** @var PersistentResource */
        $processedImageResource = $this->imageProcessingService->processProfilepicture($image);
        $this->user->setProfilepicture($processedImageResource);  // set the processed one

        $this->userRepository->update($this->user);

        $this->addFlashMessage('Updated your profile picture');
        $this->redirect('index');
    }

    /**
     * Changes the password of the account
     *
     * @param Account $account
     * @param string $password
     * @Flow\Validate(argumentName="password", type="NotEmpty")
     * @param string $passwordRepeat
     * @Flow\Validate(argumentName="passwordRepeat", type="NotEmpty")
     *
     * @return void
     */
    public function changePasswordAction($account, $password, $passwordRepeat)
    {
        if ($password != $passwordRepeat) {
            $this->addFlashMessage('The entered passwords are not identical', '', Message::SEVERITY_ERROR);
            $referrer = $this->request->getInternalArgument('__referrer');
            $this->redirect($referrer['@action'], $referrer['@controller']);
        }

        $account->setCredentialsSource($this->hashService->hashPassword($password, 'default'));
        $this->accountRepository->update($account);

        $this->addFlashMessage('Successfully changed your password');

        $referrer = $this->request->getInternalArgument('__referrer');
        $this->redirect($referrer['@action'], $referrer['@controller']);
    }

    /**
     * Deletes an account and the corresponding user
     *
     * @param boolean $confirm
     * @return void
     */
    public function deleteAction($confirm)
    {
        if (!$confirm) {
            $this->redirect('index');
        }

        if ($this->user->getProfilepicture() != null) {
            $this->resourceManager->deleteResource($this->user->getProfilepicture());
        }
        $this->userRepository->remove($this->user);
        $this->accountRepository->remove($this->securityContext->getAccount());
        $this->addFlashMessage('Your account has been deleted');
        $this->redirect('logout', 'Authentication');
    }
}
