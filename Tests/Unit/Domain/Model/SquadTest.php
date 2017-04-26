<?php
namespace SquadIT\WebApp\Tests\Unit\Domain\Model;

use SquadIT\WebApp\Domain\Model\Squad;
use SquadIT\WebApp\Domain\Model\User;

/*
 * This file is part of the SquadIT.WebApp package.
 */

/**
 * Testcase for Squad
 */
class SquadTest extends \Neos\Flow\Tests\UnitTestCase
{

    /**
     * @test
     */
    public function aNameCanBeSetAndRetrievedFromTheSquad()
    {
        $squad = new Squad('Hugo');
        $squad->setName('RandomName');
        $expected = 'RandomName';
        $actual = $squad->getName();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function aDescriptionCanBeSetAndRetrievedFromTheSquad()
    {
        $squad = new Squad('Hugo');
        $squad->setDescription('A random description that describes the squad.');
        $expected = 'A random description that describes the squad.';
        $actual = $squad->getDescription();
        $this->assertSame($expected, $actual);
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
    public function aMemberCanBeAddedToASquad()
    {
        $squad = new Squad('Hugo');
        $squad->addMember(new User('Haggl', 'Schorsch'));
        $squad->addMember(new User('Frodo', 'TheHobo'));
        $squad->addMember(new User('Jan', 'Delay'));
        $this->assertSame(count($squad->getMembers()), 3);
    }
}
