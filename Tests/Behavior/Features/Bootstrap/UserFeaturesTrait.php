<?php
namespace SquadIT\WebApp\Tests\Behavior\Features\Bootstrap;

use SquadIT\WebApp\Domain\Repository\UserRepository;
use SquadIT\WebApp\Domain\Model\User;
use PHPUnit_Framework_Assert as Assert;

/**
 * This trait contains the step definitions for the features related to the user management#
 */
trait UserFeaturesTrait
{
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
