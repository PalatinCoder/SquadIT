<?php
namespace SquadIT\WebApp\Utility;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Property\TypeConverter\AbstractTypeConverter;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;

/**
 * Converter which can convert email addresses (which are strings) to User objects by looking them up in the
 * corresponding repositories
 *
 * @Flow\Scope("singleton")
 */
class UserTypeConverter extends AbstractTypeConverter
{
    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var array<string>
     */
    protected $sourceTypes = array('string');

    /**
     * @var string
     */
    protected $targetType = 'SquadIT\WebApp\Domain\Model\User';

    /**
     * @var integer
     */
    protected $priority = 101;

    /**
     * Actually convert from $source to $targetType
     *
     * @param mixed $source
     * @Flow\Validate(argumentName="source", type="EmailAddress")
     * @param string $targetType
     * @param array $convertedChildProperties
     * @param \Neos\Flow\Property\PropertyMappingConfigurationInterface $configuration
     * @return User|\Neos\Error\Messages\Error
     */
    public function convertFrom($source, $targetType, array $convertedChildProperties = array(), \Neos\Flow\Property\PropertyMappingConfigurationInterface $configuration = null)
    {
        /** @var User $user */
        $user = $this->userRepository->findOneByAccountIdentifier($source);

        if ($user === null) {
            return new \Neos\Error\Messages\Error('The user "%s" can not be found', 1481043993, array($source));
        }

        return $user;
    }
}
