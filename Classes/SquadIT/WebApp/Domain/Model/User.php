<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(nullable=true)
     * @var string
     */
    protected $profilepicture;

    /**
     * @ORM\ManyToOne(inversedBy="members")
     * @var Squad
     */
    protected $squad;

    /**
     * @ORM\OneToOne
     * @var \TYPO3\Flow\Security\Account
     */
    protected $account;

    /**
     * Constructor of user with name as parameter.
     * @param string $firstname
     * @param string $lastname
     * @return void
     */
    public function __construct($firstname, $lastname, $account = null)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->account = $account;
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
     * @return string
     */
    public function getProfilepicture()
    {
        return $this->profilepicture;
    }

    /**
     * @param string $profilepicture
     * @return void
     */
    public function setProfilepicture($profilepicture)
    {
        $this->profilepicture = $profilepicture;
    }

    /**
     * @return Squad
     */
    public function getSquad()
    {
        return $this->squad;
    }

    /**
     * @param Squad $squad
     * @return void
     */
    public function setSquad($squad)
    {
        $this->squad = $squad;
    }

    /**
     * @return \TYPO3\Flow\Security\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
