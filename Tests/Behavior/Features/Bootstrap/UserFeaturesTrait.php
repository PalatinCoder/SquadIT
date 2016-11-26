<?php
namespace SquadIT\WebApp\Tests\Behavior\Features\Bootstrap;

use Behat\Behat\Exception\PendingException;

/**
 * This trait contains the step definitions for the features related to the user management#
 */
trait UserFeaturesTrait
{
    /**
     * @Given /^the user "([^"]*)" should exist$/
     */
    public function theUserShouldExist($arg1)
    {
        throw new PendingException();
    }
}
