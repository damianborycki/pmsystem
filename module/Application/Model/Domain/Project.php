<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Project 
 *
 * @ORM\Table(name="`PROJECT`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\ProjectRepository")
 */
class Project 
{
    /**
     * @var string $name
     * @ORM\Column(name="`NAME`", type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @var text $description
     * @ORM\Column(name="`DESCRIPTION`", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string $identifier
     * @ORM\Column(name="`IDENTIFIER`", type="string", length=20, nullable=true)
     */
    protected $identifier;

    /**
     * @var ProjectStatus $projectStatus
     * @ORM\ManyToOne(targetEntity="ProjectStatus")
     * @ORM\JoinColumn(name="PROJECTSTATUSID", referencedColumnName="ID")
     */
    protected $projectStatus;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $trackers
     * @ORM\ManyToMany(targetEntity="Tracker")
     * @ORM\JoinTable(name="PROJECTTRACKERS",
     *     joinColumns={@ORM\JoinColumn(name="PROJECTID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="TRACKERID", referencedColumnName="ID")}
     *     )
     */
    protected $trackers;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $issueCategorys
     * @ORM\ManyToMany(targetEntity="IssueCategory")
     * @ORM\JoinTable(name="PROJECTISSUECATEGORYS",
     *     joinColumns={@ORM\JoinColumn(name="PROJECTID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ISSUECATEGORYID", referencedColumnName="ID")}
     *     )
     */
    protected $issueCategorys;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="PROJECT_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $issues
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="project", cascade={"ALL"})
     */
    protected $issues;


    public function __construct()
    {
        $this->trackers = new ArrayCollection();
        $this->issueCategorys = new ArrayCollection();
        $this->issues = new ArrayCollection();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function getProjectStatus()
    {
        return $this->projectStatus;
    }

    public function setProjectStatus($projectStatus)
    {
        $this->projectStatus = $projectStatus;
        return $this;
    }

    public function getTrackers()
    {
        return $this->trackers;
    }

    public function setTrackers($trackers)
    {
        $this->trackers = $trackers;
        return $this;
    }

    public function addTrackers(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->trackers->add($item);
        }
    }

    public function removeTrackers(Collection $collection){
        foreach ($collection as $item) {
            $this->trackers->removeElement($item);
        }
    }

    public function getIssueCategorys()
    {
        return $this->issueCategorys;
    }

    public function setIssueCategorys($issueCategorys)
    {
        $this->issueCategorys = $issueCategorys;
        return $this;
    }

    public function addIssueCategorys(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->issueCategorys->add($item);
        }
    }

    public function removeIssueCategorys(Collection $collection){
        foreach ($collection as $item) {
            $this->issueCategorys->removeElement($item);
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

    public function getIssues()
    {
        return $this->issues;
    }

    public function setIssues($issues)
    {
        $this->issues = $issues;
        return $this;
    }

    public function addIssues(Collection $collection)
    {
        foreach ($collection as $item) {
            $item->setProject($this);
            $this->issues->add($item);
        }
    }

    public function removeIssues(Collection $collection){
        foreach ($collection as $item) {
            $item->setProject(null);
            $this->issues->removeElement($item);
        }
    }

    
    public function __toString()
    {
        return (string)($this->getId());
    }

}
