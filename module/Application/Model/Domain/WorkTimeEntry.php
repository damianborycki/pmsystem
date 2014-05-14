<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * WorkTimeEntry 
 *
 * @ORM\Table(name="`WORKTIMEENTRY`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\WorkTimeEntryRepository")
 */
class WorkTimeEntry 
{
    /**
     * @var ActivityEntry $activityEntries
     * @ORM\ManyToOne(targetEntity="ActivityEntry")
     * @ORM\JoinColumn(name="ACTIVITYENTRIESID", referencedColumnName="ID")
     */
    protected $activityEntries;

    /**
     * @var integer $hours
     * @ORM\Column(name="`HOURS`", type="integer", nullable=true)
     */
    protected $hours;

    /**
     * @var string $comment
     * @ORM\Column(name="`COMMENT`", type="string", length=100, nullable=true)
     */
    protected $comment;

    /**
     * @var integer $entryYear
     * @ORM\Column(name="`ENTRYYEAR`", type="integer", nullable=true)
     */
    protected $entryYear;

    /**
     * @var integer $entryMonth
     * @ORM\Column(name="`ENTRYMONTH`", type="integer", nullable=true)
     */
    protected $entryMonth;

    /**
     * @var integer $entryWeek
     * @ORM\Column(name="`ENTRYWEEK`", type="integer", nullable=true)
     */
    protected $entryWeek;

    /**
     * @var datetime $entryDate
     * @ORM\Column(name="`ENTRYDATE`", type="datetime", nullable=true)
     */
    protected $entryDate;

    /**
     * @var datetime $creationTime
     * @ORM\Column(name="`CREATIONTIME`", type="datetime", nullable=true)
     */
    protected $creationTime;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="WORKTIMEENTRY_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
    }

    public function getActivityEntries()
    {
        return $this->activityEntries;
    }

    public function setActivityEntries($activityEntries)
    {
        $this->activityEntries = $activityEntries;
        return $this;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function setHours($hours)
    {
        $this->hours = $hours;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function getEntryYear()
    {
        return $this->entryYear;
    }

    public function setEntryYear($entryYear)
    {
        $this->entryYear = $entryYear;
        return $this;
    }

    public function getEntryMonth()
    {
        return $this->entryMonth;
    }

    public function setEntryMonth($entryMonth)
    {
        $this->entryMonth = $entryMonth;
        return $this;
    }

    public function getEntryWeek()
    {
        return $this->entryWeek;
    }

    public function setEntryWeek($entryWeek)
    {
        $this->entryWeek = $entryWeek;
        return $this;
    }

    public function getEntryDate()
    {
        return $this->entryDate;
    }

    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;
        return $this;
    }

    public function getCreationTime()
    {
        return $this->creationTime;
    }

    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    
    public function __toString()
    {
        return (string)($this->getId());
    }

}
