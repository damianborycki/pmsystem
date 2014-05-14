<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * User 
 *
 * @ORM\Table(name="`USER`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\UserRepository")
 */
class User 
{
    /**
     * @var string $login
     * @ORM\Column(name="`LOGIN`", type="string", length=50, nullable=true)
     */
    protected $login;

    /**
     * @var string $hashedPassword
     * @ORM\Column(name="`HASHEDPASSWORD`", type="string", length=100, nullable=true)
     */
    protected $hashedPassword;

    /**
     * @var string $salt
     * @ORM\Column(name="`SALT`", type="string", length=100, nullable=true)
     */
    protected $salt;

    /**
     * @var string $firstName
     * @ORM\Column(name="`FIRSTNAME`", type="string", length=100, nullable=true)
     */
    protected $firstName;

    /**
     * @var string $lastName
     * @ORM\Column(name="`LASTNAME`", type="string", length=100, nullable=true)
     */
    protected $lastName;

    /**
     * @var string $mail
     * @ORM\Column(name="`MAIL`", type="string", length=100, nullable=true)
     */
    protected $mail;

    /**
     * @var boolean $isAdmin
     * @ORM\Column(name="`ISADMIN`", type="boolean", nullable=true)
     */
    protected $isAdmin;

    /**
     * @var boolean $isActive
     * @ORM\Column(name="`ISACTIVE`", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var UserType $userType
     * @ORM\ManyToOne(targetEntity="UserType")
     * @ORM\JoinColumn(name="USERTYPEID", referencedColumnName="ID")
     */
    protected $userType;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="USER_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;


    public function __construct()
    {
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
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
