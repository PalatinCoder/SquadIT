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
    protected $dummyUser;

    protected function setUp()
    {
        $this->dummyUser = new User('Dummy', 'User');
    }
    /**
     * @test
     */
    public function aNameCanBeSetAndRetrievedFromTheSquad()
    {
        $squad = new Squad('Hugo', $this->dummyUser);
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
        $squad = new Squad('Hugo', $this->dummyUser);
        $squad->setDescription('A random description that describes the squad.');
        $expected = 'A random description that describes the squad.';
        $actual = $squad->getDescription();
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function theCorrectProfilePictureUriCanBeRetrieved()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    /**
     * @test
     */
    public function aPlaceholderIsShownIfTheSquadHasNoProfilepicture()
    {
        $squad = new Squad("Testsquad", $this->dummyUser);
        $uri = $squad->getProfilepictureUri();
        $this->assertStringStartsWith('https://placehold.it', $uri, "The URI host is not placehold.it");
        $this->assertStringEndsWith('text=Te', $uri, "The URI does not contain the user initials");
    }

    /**
     * @test
     */
    public function aMemberCanBeAddedToASquad()
    {
        $squad = new Squad('Hugo', $this->dummyUser);
        $squad->addMember(new User('Haggl', 'Schorsch'));
        $squad->addMember(new User('Frodo', 'TheHobo'));
        $squad->addMember(new User('Jan', 'Delay'));
        $this->assertSame(count($squad->getMembers()), 3);
    }
}
