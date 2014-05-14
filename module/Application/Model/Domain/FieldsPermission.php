<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * FieldsPermission 
 *
 * @ORM\Table(name="`FIELDSPERMISSION`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\FieldsPermissionRepository")
 */
class FieldsPermission 
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
     * @var Field $field
     * @ORM\ManyToOne(targetEntity="Field")
     * @ORM\JoinColumn(name="FIELDID", referencedColumnName="ID")
     */
    protected $field;

    /**
     * @var IssueStatus $issueStatus
     * @ORM\ManyToOne(targetEntity="IssueStatus")
     * @ORM\JoinColumn(name="ISSUESTATUSID", referencedColumnName="ID")
     */
    protected $issueStatus;

    /**
     * @var FieldPermission $fieldPermission
     * @ORM\ManyToOne(targetEntity="FieldPermission")
     * @ORM\JoinColumn(name="FIELDPERMISSIONID", referencedColumnName="ID")
     */
    protected $fieldPermission;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="FIELDSPERMISSION_SEQ")
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

    public function getField()
    {
        return $this->field;
    }

    public function setField($field)
    {
        $this->field = $field;
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

    public function getFieldPermission()
    {
        return $this->fieldPermission;
    }

    public function setFieldPermission($fieldPermission)
    {
        $this->fieldPermission = $fieldPermission;
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
