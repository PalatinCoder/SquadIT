<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Neos\Flow\ResourceManagement\PersistentResource;

/**
 * @Flow\Entity
 */
class Squad
{

    /**
     * @Flow\Inject
     * @var \Neos\Flow\ResourceManagement\ResourceManager
     */
    protected $resourceManager;

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
     * @ORM\OneToOne
     * @var PersistentResource
     */
    protected $profilepicture;

    /**
     * @ORM\ManyToMany(inversedBy="squads")
     * @var Collection<User>
     */
    protected $members;

    /**
     * @param string $name
     * @return void
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
            return "https://placehold.it/200/888/fff?text=" . substr($this->name, 0, 2);
        }
        return $this->resourceManager->getPublicPersistentResourceUri($this->profilepicture);
    }

    /**
     * @param PersistentResource $profilepicture
     * @return void
     */
    public function setProfilepicture($profilepicture)
    {
        $this->profilepicture = $profilepicture;
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
