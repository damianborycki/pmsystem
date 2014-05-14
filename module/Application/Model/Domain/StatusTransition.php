<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * StatusTransition 
 *
 * @ORM\Table(name="`STATUSTRANSITION`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\StatusTransitionRepository")
 */
class StatusTransition 
{
    /**
     * @var Tracker $tracker
     * @ORM\ManyToOne(targetEntity="Tracker")
     * @ORM\JoinColumn(name="TRACKERID", referencedColumnName="ID")
     */
    protected $tracker;

    /**
     * @var MemberRole $memberRole
     * @ORM\ManyToOne(targetEntity="MemberRole")
     * @ORM\JoinColumn(name="MEMBERROLEID", referencedColumnName="ID")
     */
    protected $memberRole;

    /**
     * @var IssueStatus $prevStatus
     * @ORM\ManyToOne(targetEntity="IssueStatus")
     * @ORM\JoinColumn(name="PREVSTATUSID", referencedColumnName="ID")
     */
    protected $prevStatus;

    /**
     * @var IssueStatus $nextStatus
     * @ORM\ManyToOne(targetEntity="IssueStatus")
     * @ORM\JoinColumn(name="NEXTSTATUSID", referencedColumnName="ID")
     */
    protected $nextStatus;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="STATUSTRANSITION_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
    }

    public function getTracker()
    {
        return $this->tracker;
    }

    public function setTracker($tracker)
    {
        $this->tracker = $tracker;
        return $this;
    }

    public function getMemberRole()
    {
        return $this->memberRole;
    }

    public function setMemberRole($memberRole)
    {
        $this->memberRole = $memberRole;
        return $this;
    }

    public function getPrevStatus()
    {
        return $this->prevStatus;
    }

    public function setPrevStatus($prevStatus)
    {
        $this->prevStatus = $prevStatus;
        return $this;
    }

    public function getNextStatus()
    {
        return $this->nextStatus;
    }

    public function setNextStatus($nextStatus)
    {
        $this->nextStatus = $nextStatus;
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
