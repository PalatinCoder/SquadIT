<?php
namespace SquadIT\WebApp\Tests\Unit\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

/**
 * Testcase for User
 */
class UserTest extends \TYPO3\Flow\Tests\UnitTestCase
{

    /**
     * @test
     */
    public function aFirstNameCanBeSetAndRetrievedFromTheUser()
    {
        $user = new User();
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
        $user = new User();
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
        $user = new User();
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
        $user = new User();
        $user->setFirstname('Random');
        $user->setLastname('Name');
        $expected = 'Random Name';
        $actual = $user->getFullName();
        $this->assertSame($expected, $actual);
    }
}
