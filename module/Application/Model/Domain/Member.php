<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Member 
 *
 * @ORM\Table(name="`MEMBER`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\MemberRepository")
 */
class Member 
{
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
     * @var \Doctrine\Common\Collections\ArrayCollection $memberRoles
     * @ORM\ManyToMany(targetEntity="MemberRole")
     * @ORM\JoinTable(name="MEMBERMEMBERROLES",
     *     joinColumns={@ORM\JoinColumn(name="MEMBERID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="MEMBERROLEID", referencedColumnName="ID")}
     *     )
     */
    protected $memberRoles;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="MEMBER_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
        $this->memberRoles = new ArrayCollection();
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

    public function getMemberRoles()
    {
        return $this->memberRoles;
    }

    public function setMemberRoles($memberRoles)
    {
        $this->memberRoles = $memberRoles;
        return $this;
    }

    public function addMemberRoles(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->memberRoles->add($item);
        }
    }

    public function removeMemberRoles(Collection $collection){
        foreach ($collection as $item) {
            $this->memberRoles->removeElement($item);
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

}
