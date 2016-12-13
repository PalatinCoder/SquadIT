<?php
namespace SquadIT\WebApp\Tests\Behavior\Features\Bootstrap;

use Behat\Gherkin\Node\TableNode;
use SquadIT\WebApp\Domain\Repository\UserRepository;
use SquadIT\WebApp\Domain\Model\User;
use TYPO3\Flow\Security\AccountRepository;
use PHPUnit_Framework_Assert as Assert;

/**
 * This trait contains the step definitions for the features related to the user management#
 */
trait UserFeaturesTrait
{
    /**
     * @Given /^there are users:$/
     */
    public function thereAreUsers(TableNode $table)
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->objectManager->get(UserRepository::class);
        /** @var AccountRepository $accountRepository */
        $accountRepository = $this->objectManager->get(AccountRepository::class);

        $hash = $table->getHash();
        foreach ($hash as $row) {
            $account = $accountRepository->findOneByAccountIdentifier($row['account']);
            $user = new User($row['firstname'], $row['lastname'], $account);
            $userRepository->add($user);
        }

        $this->getSubcontext('flow')->persistAll();
    }

    /**
     * @Then /^the user "([^"]*)" should exist$/
     */
    public function theUserShouldExist($fullname)
    {
        /** var UserRepository $userRepository */
        $userRepository = $this->objectManager->get(UserRepository::class);
        $firstname = explode(' ', $fullname)[0];
        /** @var User $user */
        $user = $userRepository->findOneByFirstname($firstname);
        Assert::assertEquals($fullname, $user->getFullname());
    }
}
