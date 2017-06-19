<?php
namespace SquadIT\WebApp\Service;

use Neos\Flow\Annotations as Flow;
use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Repository\UserRepository;
use Neos\Cache\CacheAwareInterface;
use Neos\Flow\Persistence\PersistenceManagerInterface;

/**
 * @Flow\Scope("singleton")
 */
class UserContext implements CacheAwareInterface
{

    /**
     * @var UserRepository
     * @Flow\Inject
     */
    protected $userRepository;

    /**
     * @var \Neos\Flow\Security\Context
     * @Flow\Inject
     */
    protected $securityContext;

    /**
     * @var PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * @return User
     */
    public function getUser()
    {
        $account = $this->securityContext->getAccount();
        $user = $this->userRepository->findOneByAccount($account);
        return $user;
    }

    /**
     * Get the identifiers of the user's squads
     * @return array<string>
     */
    public function getSquads()
    {
        $user = $this->getUser();
        if ($user === null) {
            return array();
        }
        $squads = $user->getSquads();
        $identifiers = array();
        foreach ($squads as $squad) {
            $identifiers[] = $this->persistenceManager->getIdentifierByObject($squad);
        }
        return $identifiers;
    }

    /**
     * @return string
     */
    public function getCacheEntryIdentifier()
    {
        $user = $this->getUser();
        if ($user === null) {
            return null;
        }
        return $this->persistenceManager->getIdentifierByObject($user);
    }
}
