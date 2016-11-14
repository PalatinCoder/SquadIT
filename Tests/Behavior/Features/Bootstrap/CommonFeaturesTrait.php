<?php
namespace SquadIT\WebApp\Tests\Behavior\Features\Bootstrap;

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

/**
 * A trait containing the step definitions to run common steps
 */
trait CommonFeaturesTrait
{

    /**
     * @Given /^a squad "([^"]*)" exists$/
     */
    public function aSquadExists($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^there are users:$/
     */
    public function thereAreUsers(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I am logged in as "([^"]*)"$/
     */
    public function iAmLoggedInAs($arg1)
    {
        throw new PendingException();
    }
}
