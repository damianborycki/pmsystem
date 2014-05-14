<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Query 
 *
 * @ORM\Table(name="`QUERY`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\QueryRepository")
 */
class Query 
{
    /**
     * @var QueryType $queryType
     * @ORM\ManyToOne(targetEntity="QueryType")
     * @ORM\JoinColumn(name="QUERYTYPEID", referencedColumnName="ID")
     */
    protected $queryType;

    /**
     * @var Project $project
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="PROJECTID", referencedColumnName="ID")
     */
    protected $project;

    /**
     * @var User $user
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="USERID", referencedColumnName="ID")
     */
    protected $user;

    /**
     * @var string $name
     * @ORM\Column(name="`NAME`", type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @var boolean $isPublic
     * @ORM\Column(name="`ISPUBLIC`", type="boolean", nullable=true)
     */
    protected $isPublic;

    /**
     * @var text $selectCriteria
     * @ORM\Column(name="`SELECTCRITERIA`", type="text", nullable=true)
     */
    protected $selectCriteria;

    /**
     * @var text $whereCriteria
     * @ORM\Column(name="`WHERECRITERIA`", type="text", nullable=true)
     */
    protected $whereCriteria;

    /**
     * @var text $sortCriteria
     * @ORM\Column(name="`SORTCRITERIA`", type="text", nullable=true)
     */
    protected $sortCriteria;

    /**
     * @var text $groupCriteria
     * @ORM\Column(name="`GROUPCRITERIA`", type="text", nullable=true)
     */
    protected $groupCriteria;

    /**
     * @var text $detailCriteria
     * @ORM\Column(name="`DETAILCRITERIA`", type="text", nullable=true)
     */
    protected $detailCriteria;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="QUERY_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
    }

    public function getQueryType()
    {
        return $this->queryType;
    }

    public function setQueryType($queryType)
    {
        $this->queryType = $queryType;
        return $this;
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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
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

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    public function getSelectCriteria()
    {
        return $this->selectCriteria;
    }

    public function setSelectCriteria($selectCriteria)
    {
        $this->selectCriteria = $selectCriteria;
        return $this;
    }

    public function getWhereCriteria()
    {
        return $this->whereCriteria;
    }

    public function setWhereCriteria($whereCriteria)
    {
        $this->whereCriteria = $whereCriteria;
        return $this;
    }

    public function getSortCriteria()
    {
        return $this->sortCriteria;
    }

    public function setSortCriteria($sortCriteria)
    {
        $this->sortCriteria = $sortCriteria;
        return $this;
    }

    public function getGroupCriteria()
    {
        return $this->groupCriteria;
    }

    public function setGroupCriteria($groupCriteria)
    {
        $this->groupCriteria = $groupCriteria;
        return $this;
    }

    public function getDetailCriteria()
    {
        return $this->detailCriteria;
    }

    public function setDetailCriteria($detailCriteria)
    {
        $this->detailCriteria = $detailCriteria;
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
