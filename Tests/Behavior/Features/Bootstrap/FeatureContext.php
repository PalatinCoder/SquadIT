<?php

use Behat\MinkExtension\Context\MinkContext;
use Neos\Behat\Tests\Behat\FlowContext;
use Neos\Flow\Tests\Behavior\Features\Bootstrap\IsolatedBehatStepsTrait;
use Neos\Flow\Tests\Behavior\Features\Bootstrap\SecurityOperationsTrait;
use Neos\Flow\Tests\Functional\Command\BehatTestHelper;
use Neos\Flow\Utility\Environment;
use SquadIT\WebApp\Tests\Behavior\Features\Bootstrap\AccountFeaturesTrait;
use SquadIT\WebApp\Tests\Behavior\Features\Bootstrap\UserFeaturesTrait;

require_once(__DIR__ . '/../../../../../../Application/Neos.Behat/Tests/Behat/FlowContext.php');
require_once(__DIR__ . '/../../../../../../Framework/Neos.Flow/Tests/Behavior/Features/Bootstrap/IsolatedBehatStepsTrait.php');
require_once(__DIR__ . '/../../../../../../Framework/Neos.Flow/Tests/Behavior/Features/Bootstrap/SecurityOperationsTrait.php');
require_once(__DIR__ . '/AccountFeaturesTrait.php');
require_once(__DIR__ . '/UserFeaturesTrait.php');

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    use AccountFeaturesTrait;
    use UserFeaturesTrait;
    use IsolatedBehatStepsTrait;
    use SecurityOperationsTrait;

    /**
     * @var string
     */
    protected $behatTestHelperObjectName = BehatTestHelper::class;

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
        $this->environment = $this->objectManager->get(Environment::class);
        $this->setupSecurity();
    }
}
