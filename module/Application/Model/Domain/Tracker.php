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
 * Tracker 
 *
 * @ORM\Table(name="`TRACKER`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\TrackerRepository")
 */
class Tracker implements InputFilterAwareInterface
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
     * @var boolean $assigned
     * @ORM\Column(name="`ASSIGNED`", type="boolean", nullable=true)
     */
    protected $assigned;
    
    /**
     * @var boolean $category
     * @ORM\Column(name="`CATEGORY`", type="boolean", nullable=true)
     */
    protected $category;
    
    /**
     * @var boolean $fiedVersion
     * @ORM\Column(name="`FIXEDVERSION`", type="boolean", nullable=true)
     */
    protected $fiedVersion;
    
    /**
     * @var boolean $parentIssue
     * @ORM\Column(name="`PARENTISSUE`", type="boolean", nullable=true)
     */
    protected $parentIssue;
    
    /**
     * @var boolean $startDate
     * @ORM\Column(name="`STARTDATE`", type="boolean", nullable=true)
     */
    protected $startDate;
    
    /**
     * @var boolean $dueDate
     * @ORM\Column(name="`DUEDATE`", type="boolean", nullable=true)
     */
    protected $dueDate;
    
    /**
     * @var boolean $estimateHours
     * @ORM\Column(name="`ESTIMATEDHOURS`", type="boolean", nullable=true)
     */
    protected $estimateHours;
    
    /**
     * @var boolean $doneRadio
     * @ORM\Column(name="`DONERADIO`", type="boolean", nullable=true)
     */
    protected $doneRadio;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $fields
     * @ORM\ManyToMany(targetEntity="Field")
     * @ORM\JoinTable(name="TRACKERFIELDS",
     *     joinColumns={@ORM\JoinColumn(name="TRACKERID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="FIELDID", referencedColumnName="ID")}
     *     )
     */
    protected $fields;

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="TRACKER_SEQ")
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

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function addFields(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->fields->add($item);
        }
    }

    public function removeFields(Collection $collection){
        foreach ($collection as $item) {
            $this->fields->removeElement($item);
        }
    }

     /**/
    public function getAssigned()
    {
        return $this->assigned;
    }

    public function setAssigned($assigned)
    {
        $this->assigned = $assigned;
        return $this;
    }
    
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    
    public function getFiedVersion()
    {
        return $this->fiedVersion;
    }

    public function setFiedVersion($fiedVersion)
    {
        $this->fiedVersion = $fiedVersion;
        return $this;
    }
    public function getParentIssue()
    {
        return $this->parentIssue;
    }

    public function setParentIssue($parentIssue)
    {
        $this->parentIssue = $parentIssue;
        return $this;
    }
    
    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }
    public function getDueDate()
    {
        return $this->dueDate;
    }
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }
    public function getEstimateHours()
    {
        return $this->estimateHours;
    }

    public function setEstimateHours($estimateHours)
    {
        $this->estimateHours = $estimateHours;
        return $this;
    }
    public function getDoneRadio()
    {
        return $this->doneRadio;
    }

    public function setDoneRadio($doneRadio)
    {
        $this->doneRadio = $doneRadio;
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
                      'name' => 'description',
                      'required' => false,
                      'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                      'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 2,
                                'max'      => 200,
                            ),
                        ),
                    ),
                  ))
           );
          
          $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'position',
                    'required' => false
                ))
            );   
          
              $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'IsDefault',
                    'required' => false
                ))
            );
              
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'IsActive',
                    'required' => false
                ))
            );  
              
            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'Assigned',
                    'required' => false
                ))
            );  
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'Category',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'FiedVersion',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'ParentIssue',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'StartDate',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'DueDate',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'EstimateHours',
                    'required' => false
                ))
            ); 
           $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'DoneRadio',
                    'required' => false
                ))
            );   
           


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}
