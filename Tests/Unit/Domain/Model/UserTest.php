<?php
namespace SquadIT\WebApp\Tests\Unit\Domain\Model;

use SquadIT\WebApp\Domain\Model\User;
use SquadIT\WebApp\Domain\Model\Squad;
use TYPO3\Flow\Security\AccountFactory;
use TYPO3\Flow\Security\Account;

/*
 * This file is part of the SquadIT.WebApp package.
 */

/**
 * Testcase for User
 */
class UserTest extends \TYPO3\Flow\Tests\UnitTestCase
{

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\AccountFactory
     */
    protected $accountFactory;

    /**
     * @test
     */
    public function aFirstNameCanBeSetAndRetrievedFromTheUser()
    {
        /** @var User $user */
        $user = new User('Hugo', 'Tester');
        $user->setFirstname('RandomName');
        $expected = 'RandomName';
        $actual = $user->getFirstname();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function aLastNameCanBeSetAndRetrievedFromTheUser()
    {
        /** @var User $user */
        $user = new User('Hugo', 'Tester');
        $user->setLastname('RandomName');
        $expected = 'RandomName';
        $actual = $user->getLastname();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function aSquadCanBeAssignedToAUser()
    {
        /** @var User $user */
        $user = new User('Hugo', 'Tester');
        $squad = new Squad();
        $user->setSquad($squad);
        $this->assertInstanceOf(Squad::class, $user->getSquad());
    }

    /**
     * @test
     */
    public function aPictureCanBeSet()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    /**
     * @test
     */
    public function aFullNameCanBeRetrievedFromAUser()
    {
        /** @var User $user */
        $user = new User('Hugo', 'Tester');
        $expected = 'Hugo Tester';
        $actual = $user->getFullName();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function anAccountCanBeAssignedToAndRetrievedFromTheUser()
    {
        $account = $this->getAccessibleMock(Account::class, ['dummy']);
        $user = new User('Hugo', 'Tester', $account);

        $this->assertInstanceOf(Account::class, $user->getAccount());
    }
}