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
 * IssueStatus
 *
 * @ORM\Table(name="`ISSUESTATUS`")
 * @ORM\Entity(repositoryClass="\Application\Model\Infrastructure\Repositories\IssueStatusRepository")
 */
class IssueStatus implements InputFilterAwareInterface
{
    /**
     * @var string $code
     * @ORM\Column(name="`CODE`", type="string", length=50, nullable=false)
     */
    protected $code;
    
    /**
     * @var string $name
     * @ORM\Column(name="NAME", type="string", length=100, nullable=false)
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
     * @var boolean $isClosed
     * @ORM\Column(name="`ISCLOSED`", type="boolean", nullable=true)
     */
    protected $isClosed;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ISSUESTATUS_SEQ")
     * @ORM\Column(name="`ID`", type="integer", nullable=false)
     */
    protected $id;

    protected $inputFilter;
    
    public function __construct()
    {
        $this->estimatedActivitys = new ArrayCollection();
        $this->assignedUsers = new ArrayCollection();
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

    public function getIsClosed()
    {
        return $this->isClosed;
    }

    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;
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
        return (string)($this->getName());
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
                    'name'     => 'name',
                    'required' => true,
                    'options' => array(
                        'rncoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 140,
                    )
                ))
            );
            
          $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'IsClosed',
                    'required' => false
                ))
            );
          
              $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'IsDefault',
                    'required' => false
                ))
            );


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
