<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\ResourceManagement\PersistentResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Flow\Entity
 */
class User
{

    /**
     * @Flow\Inject
     * @var \Neos\Flow\ResourceManagement\ResourceManager
     */
    protected $resourceManager;

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
     * @var PersistentResource
     */
    protected $profilepicture;

    /**
     * @ORM\ManyToMany(mappedBy="members")
     * @var Collection<Squad>
     */
    protected $squads;

    /**
     * @ORM\OneToOne
     * @var \Neos\Flow\Security\Account
     */
    protected $account;

    /**
     * Constructor of user with name as parameter.
     * @param string $firstname
     * @param string $lastname
     * @param \Neos\Flow\Security\Account $account
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
     * @return PersistentResource
     */
    public function getProfilepicture()
    {
        return $this->profilepicture;
    }

    /**
     * @return string
     */
    public function getProfilepictureUri()
    {
        if ($this->profilepicture == null) {
            return "https://placehold.it/200/888/fff?text=" . substr($this->firstname, 0, 1) . substr($this->lastname, 0, 1);
        }
        return $this->resourceManager->getPublicPersistentResourceUri($this->profilepicture);
    }

    /**
     * @param PersistentResource $profilepicture
     * @return void
     */
    public function setProfilepicture(PersistentResource $profilepicture)
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
     * @param Collection $squads
     */
    public function setSquads($squads)
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
     * @return \Neos\Flow\Security\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
