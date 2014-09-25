<?php
namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Field 
 *
 * @ORM\Table(name="`FIELD`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\FieldRepository")
 */
class Field 
{
    //
     // @var FieldContext $fieldContext
     // @ORM\ManyToOne(targetEntity="FieldContext")
     // @ORM\JoinColumn(name="FIELDCONTEXTID", referencedColumnName="ID")
     //
    //protected $fieldContext;

    /**
     * @var string $name
     * @ORM\Column(name="`NAME`", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var integer $maxValue
     * @ORM\Column(name="`MAXVALUE`", type="integer", nullable=true)
     */
    protected $maxValue;

    /**
     * @var integer $minValue
     * @ORM\Column(name="`MINVALUE`", type="integer", nullable=true)
     */
    protected $minValue;

    /**
     * @var boolean $isHidden
     * @ORM\Column(name="`ISHIDDEN`", type="boolean", nullable=true)
     */
    protected $isHidden;

    /**
     * @var string $regexp
     * @ORM\Column(name="`REGEXP`", type="string", length=1000, nullable=true)
     */
    protected $regexp;

    /**
     * @var string $type
     * @ORM\Column(name="`TYPE`", type="string", length=25, nullable=false)
     */
    protected $type;

    /**
     * @var boolean $isRequired
     * @ORM\Column(name="`ISREQUIRED`", type="boolean", nullable=true)
     */
    protected $isRequired;

    /**
     * @var boolean $isForAll
     * @ORM\Column(name="`ISFORALL`", type="boolean", nullable=true)
     */
    protected $isForAll;

    /**
     * @var boolean $isFilter
     * @ORM\Column(name="`ISFILTER`", type="boolean", nullable=true)
     */
    protected $isFilter;

    /**
     * @var string $defaultValue
     * @ORM\Column(name="`DEFAULTVALUE`", type="string", length=100, nullable=true)
     */
    protected $defaultValue;

    /**
     * @var boolean $isMultiple
     * @ORM\Column(name="`ISMULTIPLE`", type="boolean", nullable=true)
     */
    protected $isMultiple;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="FIELD_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
      
    protected $id;

     /**
     * @var boolean $isActive
     * @ORM\Column(name="`ISACTIVE`", type="boolean", nullable=true)
     */
    protected $isActive;

    public function __construct()
    {
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

    public function getMaxValue()
    {
        return $this->maxValue;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }    
    
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;
        return $this;
    }

    public function getMinValue()
    {
        return $this->minValue;
    }

    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;
        return $this;
    }

    public function getRegexp()
    {
        return $this->regexp;
    }

    public function setRegexp($regexp)
    {
        $this->regexp = $regexp;
        return $this;
    }

    public function getIsRequired()
    {
        return $this->isRequired;
    }

    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;
        return $this;
    }

    public function getIsHidden()
    {
        return $this->isHidden;
    }

    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    public function getIsForAll()
    {
        return $this->isForAll;
    }

    public function setIsForAll($isForAll)
    {
        $this->isForAll = $isForAll;
        return $this;
    }

    public function getIsFilter()
    {
        return $this->isFilter;
    }

    public function setIsFilter($isFilter)
    {
        $this->isFilter = $isFilter;
        return $this;
    }

    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getIsMultiple()
    {
        return $this->isMultiple;
    }

    public function setIsMultiple($isMultiple)
    {
        $this->isMultiple = $isMultiple;
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
