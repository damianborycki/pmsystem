<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * EstimatedActivity 
 *
 * @ORM\Table(name="`ESTIMATEDACTIVITY`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\EstimatedActivityRepository")
 */
class EstimatedActivity 
{
    /**
     * @var IssueActivity $issueActivity
     * @ORM\ManyToOne(targetEntity="IssueActivity")
     * @ORM\JoinColumn(name="ISSUEACTIVITYID", referencedColumnName="ID")
     */
    protected $issueActivity;

    /**
     * @var integer $hours
     * @ORM\Column(name="`HOURS`", type="integer", nullable=true)
     */
    protected $hours;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ESTIMATEDACTIVITY_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var Issue $issue
     * @ORM\ManyToOne(targetEntity="Issue")
     * @ORM\JoinColumn(name="ISSUEID", referencedColumnName="ID")
     */
    protected $issue;


    public function __construct()
    {
    }

    public function getIssueActivity()
    {
        return $this->issueActivity;
    }

    public function setIssueActivity($issueActivity)
    {
        $this->issueActivity = $issueActivity;
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getIssue()
    {
        return $this->issue;
    }

    public function setIssue($issue)
    {
        $this->issue = $issue;
        return $this;
    }

    
    public function __toString()
    {
        return (string)($this->getId());
    }

}
