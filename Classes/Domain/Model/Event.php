<?php
namespace SquadIT\WebApp\Domain\Model;

/*
 * This file is part of the SquadIT.WebApp package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 * @codeCoverageIgnore
 */
class Event
{

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     */
    protected $title;

    /**
     * @var \SquadIT\WebApp\Domain\Model\Squad
     * @ORM\ManyToOne(inversedBy="events")
     * @Flow\Validate(type="NotEmpty")
     */
    protected $squad;

    /**
     * @var \DateTime
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="DateTime")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @Flow\Validate(type="DateTime")
     */
    protected $endDate;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $location;


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return \SquadIT\WebApp\Domain\Model\Squad
     */
    public function getSquad()
    {
        return $this->squad;
    }

    /**
     * @param \SquadIT\WebApp\Domain\Model\Squad $squad
     * @return void
     */
    public function setSquad($squad)
    {
        $this->squad = $squad;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return void
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return void
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}
