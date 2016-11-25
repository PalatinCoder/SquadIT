<?php
namespace SquadIT\WebApp\Controller;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;

class UserController extends \TYPO3\Flow\Mvc\Controller\ActionController
{

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
     * @return void
     */
    public function createAction()
    {
        $this->addFlashMessage('Sorry, registration is not implemented yet', 'Hang on!', Message::SEVERITY_NOTICE);
        $this->forward('index', 'standard');
    }
}
