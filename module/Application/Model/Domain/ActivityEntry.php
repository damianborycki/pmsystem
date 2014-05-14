<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ActivityEntry 
 *
 * @ORM\Table(name="`ACTIVITYENTRY`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\ActivityEntryRepository")
 */
class ActivityEntry 
{
    /**
     * @var Project $project
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="PROJECTID", referencedColumnName="ID")
     */
    protected $project;

    /**
     * @var Issue $issue
     * @ORM\ManyToOne(targetEntity="Issue")
     * @ORM\JoinColumn(name="ISSUEID", referencedColumnName="ID")
     */
    protected $issue;

    /**
     * @var IssueActivity $issueActivities
     * @ORM\ManyToOne(targetEntity="IssueActivity")
     * @ORM\JoinColumn(name="ISSUEACTIVITIESID", referencedColumnName="ID")
     */
    protected $issueActivities;

    /**
     * @var User $user
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="USERID", referencedColumnName="ID")
     */
    protected $user;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ACTIVITYENTRY_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
    }

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project)
    {
        $this->project = $project;
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

    public function getIssueActivities()
    {
        return $this->issueActivities;
    }

    public function setIssueActivities($issueActivities)
    {
        $this->issueActivities = $issueActivities;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
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
