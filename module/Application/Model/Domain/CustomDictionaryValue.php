<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * CustomDictionaryValue 
 *
 * @ORM\Table(name="`CUSTOMDICTIONARYVALUE`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\CustomDictionaryValueRepository")
 */
class CustomDictionaryValue 
{
    /**
     * @var string $code
     * @ORM\Column(name="`CODE`", type="string", length=50, nullable=false)
     */
    protected $code;

    /**
     * @var string $name
     * @ORM\Column(name="`NAME`", type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     * @var string $value
     * @ORM\Column(name="`VALUE`", type="string", length=100, nullable=false)
     */
    protected $value;

    /**
     * @var integer $position
     * @ORM\Column(name="`POSITION`", type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var string $description
     * @ORM\Column(name="`DESCRIPTION`", type="string", length=1000, nullable=true)
     */
    protected $description;

    /**
     * @var boolean $isDefault
     * @ORM\Column(name="`ISDEFAULT`", type="boolean", nullable=true)
     */
    protected $isDefault;

    /**
     * @var boolean $isActive
     * @ORM\Column(name="`ISACTIVE`", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CUSTOMDICTIONARYVALUE_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $customDictionarys
     * @ORM\ManyToMany(targetEntity="CustomDictionary", mappedBy="customDictionaryValues")
     */
    protected $customDictionarys;


    public function __construct()
    {
        $this->customDictionarys = new ArrayCollection();
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
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

    public function getIsDefault()
    {
        return $this->isDefault;
    }

    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getCustomDictionarys()
    {
        return $this->customDictionarys;
    }

    public function setCustomDictionarys($customDictionarys)
    {
        $this->customDictionarys = $customDictionarys;
        return $this;
    }

    public function addCustomDictionarys(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->customDictionarys->add($item);
        }
    }

    public function removeCustomDictionarys(Collection $collection){
        foreach ($collection as $item) {
            $this->customDictionarys->removeElement($item);
        }
    }

    
    public function __toString()
    {
        return (string)($this->getName());
    }

}
