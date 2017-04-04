<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Resource\Resource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Flow\Entity
 */
class User
{

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected $firstname;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected $lastname;

    /**
     * @ORM\OneToOne
     * @var Resource
     */
    protected $profilepicture;

    /**
     * @ORM\ManyToMany(mappedBy="members")
     * @var Collection<Squad>
     */
    protected $squads;

    /**
     * @ORM\OneToOne
     * @var \TYPO3\Flow\Security\Account
     */
    protected $account;

    /**
     * Constructor of user with name as parameter.
     * @param string $firstname
     * @param string $lastname
     * @param \TYPO3\Flow\Security\Account $account
     * @return void
     */
    public function __construct($firstname, $lastname, $account = null)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->account = $account;
        $this->squads = new ArrayCollection();
    }

    /**
     * Returns the full name of a user as one string.
     * @return string
     */
     public function getFullName()
     {
         $fullname = $this->firstname.' '.$this->lastname;
         return $fullname;
     }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return Resource
     */
    public function getProfilepicture()
    {
        if ($this->profilepicture == null)
        {
            // return placeholder
        }
        return $this->profilepicture;
    }

    /**
     * @param Resource $profilepicture
     * @return void
     */
    public function setProfilepicture(Resource $profilepicture)
    {
        $this->profilepicture = $profilepicture;
    }

    /**
     * @return Collection
     */
    public function getSquads()
    {
        return $this->squads;
    }

    /**
     * @param Collection $squad
     */
    public function setSquads($squad)
    {
        $this->squads = $squads;
    }

    /**
     * @param Squad $squad
     */
    public function addSquad($squad)
    {
        $this->squads->add($squad);
    }

    /**
     * @return \TYPO3\Flow\Security\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
