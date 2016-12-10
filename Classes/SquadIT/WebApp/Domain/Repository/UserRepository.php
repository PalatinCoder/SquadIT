<?php
namespace SquadIT\WebApp\Domain\Repository;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;
use SquadIT\WebApp\Domain\Model\User;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\AccountRepository;

/**
 * @Flow\Scope("singleton")
 */
class UserRepository extends Repository
{
    /**
     * @Flow\Inject
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * Find a user by it's account's identifier (i.e. email address)
     *
     * @param string $accountidentifier The user's email address
     * @return User
     */
    public function findOneByAccountIdentifier($accountidentifier)
    {
        /** @var Account $account */
        $account = $this->accountRepository->findOneByAccountIdentifier($accountidentifier);
        /** @var User $user */
        $user = $this->findOneByAccount($account);
        return $user;
    }
}
