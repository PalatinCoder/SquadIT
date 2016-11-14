<?php

use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Flowpack\Behat\Tests\Behat\FlowContext;
use SquadIT\WebApp\Tests\Behavior\Features\Bootstrap\CommonFeaturesTrait;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

require_once(__DIR__ . '/../../../../../../Application/Flowpack.Behat/Tests/Behat/FlowContext.php');
require_once(__DIR__ . '/CommonFeaturesTrait.php');

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    use CommonFeaturesTrait;

    /**
     * @var string
     */
    protected $behatTestHelperObjectName = \TYPO3\Flow\Tests\Functional\Command\BehatTestHelper::class;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->useContext('flow', new FlowContext($parameters));
        $flowContext = $this->getSubcontext('flow');
        $this->objectManager = $flowContext->getObjectManager();
        $this->environment = $this->objectManager->get(\TYPO3\Flow\Utility\Environment::class);
    }
}
