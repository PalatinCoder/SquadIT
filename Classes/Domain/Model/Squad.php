<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Flow\Entity
 */
class Squad
{

    /**
     * @Flow\Identity
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(nullable=true)
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $picture;

    /**
     * @ORM\ManyToMany(inversedBy="squads")
     * @var Collection<User>
     */
    protected $members;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->members = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return void
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param ArrayCollection $members
     * @return Squad
     */
    public function setMembers(ArrayCollection $members)
    {
        $this->members = $members;
    }

    /**
     * Add a user as a member to a squad.
     *
     * @param User $member
     * @return void
     */
     public function addMember(User $member)
     {
         $this->members->add($member);
     }
}
