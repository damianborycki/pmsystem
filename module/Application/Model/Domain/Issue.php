<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Issue 
 *
 * @ORM\Table(name="`ISSUE`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\IssueRepository")
 */
class Issue implements InputFilterAwareInterface
{
    /**
     * @var Project $project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="issues")
     * @ORM\JoinColumn(name="PROJECTID", referencedColumnName="ID")
     */
    protected $project;

    /**
     * @var Issue $parent
     * @ORM\ManyToOne(targetEntity="Issue")
     * @ORM\JoinColumn(name="PARENTID", referencedColumnName="ID")
     */
    protected $parent;

    /**
     * @var Tracker $tracker
     * @ORM\ManyToOne(targetEntity="Tracker")
     * @ORM\JoinColumn(name="TRACKERID", referencedColumnName="ID")
     */
    protected $tracker;

    /**
     * @var IssueStatus $issueStatus
     * @ORM\ManyToOne(targetEntity="IssueStatus")
     * @ORM\JoinColumn(name="ISSUESTATUSID", referencedColumnName="ID")
     */
    protected $issueStatus;

    /**
     * @var string $subject
     * @ORM\Column(name="`SUBJECT`", type="string", length=1000, nullable=true)
     */
    protected $subject;

    /**
     * @var text $description
     * @ORM\Column(name="`DESCRIPTION`", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var IssuePriority $issuePriority
     * @ORM\ManyToOne(targetEntity="IssuePriority")
     * @ORM\JoinColumn(name="ISSUEPRIORITYID", referencedColumnName="ID")
     */
    protected $issuePriority;

    /**
     * @var datetime $creationTime
     * @ORM\Column(name="`CREATIONTIME`", type="datetime", nullable=true)
     */
    protected $creationTime;

    /**
     * @var User $creator
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="CREATORID", referencedColumnName="ID")
     */
    protected $creator;

    /**
     * @var datetime $closeTime
     * @ORM\Column(name="`CLOSETIME`", type="datetime", nullable=true)
     */
    protected $closeTime;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $estimatedActivitys
     * @ORM\OneToMany(targetEntity="EstimatedActivity", mappedBy="issue", cascade={"ALL"})
     */
    protected $estimatedActivitys;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $assignedUsers
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="ISSUEASSIGNEDUSERS",
     *     joinColumns={@ORM\JoinColumn(name="ISSUEID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="USERID", referencedColumnName="ID")}
     *     )
     */
    protected $assignedUsers;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ISSUE_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;

    protected $inputFilter;

    public function __construct()
    {
        $this->estimatedActivitys = new ArrayCollection();
        $this->assignedUsers = new ArrayCollection();
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

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
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

    public function getIssueStatus()
    {
        return $this->issueStatus;
    }

    public function setIssueStatus($issueStatus)
    {
        $this->issueStatus = $issueStatus;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getIssuePriority()
    {
        return $this->issuePriority;
    }

    public function setIssuePriority($issuePriority)
    {
        $this->issuePriority = $issuePriority;
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

    public function getCreator()
    {
        return $this->creator;
    }

    public function setCreator($creator)
    {
        $this->creator = $creator;
        return $this;
    }

    public function getCloseTime()
    {
        return $this->closeTime;
    }

    public function setCloseTime($closeTime)
    {
        $this->closeTime = $closeTime;
        return $this;
    }

    public function getEstimatedActivitys()
    {
        return $this->estimatedActivitys;
    }

    public function setEstimatedActivitys($estimatedActivitys)
    {
        $this->estimatedActivitys = $estimatedActivitys;
        return $this;
    }

    public function addEstimatedActivitys(Collection $collection)
    {
        foreach ($collection as $item) {
            $item->setIssue($this);
            $this->estimatedActivitys->add($item);
        }
    }

    public function removeEstimatedActivitys(Collection $collection){
        foreach ($collection as $item) {
            $item->setIssue(null);
            $this->estimatedActivitys->removeElement($item);
        }
    }

    public function getAssignedUsers()
    {
        return $this->assignedUsers;
    }

    public function setAssignedUsers($assignedUsers)
    {
        $this->assignedUsers = $assignedUsers;
        return $this;
    }

    public function addAssignedUser($user)
    {
        $this->assignedUsers->add($user);
    }

    public function addAssignedUsers(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->addAssignedUser($item);
        }
    }

    public function removeAssignedUsers(Collection $collection){
        foreach ($collection as $item) {
            $this->assignedUsers->removeElement($item);
        }
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

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'project',
                    'required' => true
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'description',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 10000,
                            ),
                        ),
                    ),
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'issuePriority',
                    'required' => true
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'issueTracker',
                    'required' => true
                ))
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
