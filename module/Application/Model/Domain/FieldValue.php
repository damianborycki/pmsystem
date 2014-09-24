<?php

namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectFields
 *
 * @ORM\Table(name="`FIELDSVALUES`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\FieldsValuesRepository")
 */
class FieldValue
{
    /**
     * @var integer $id
     * @ORM\Column(name="`ID`", type="int", length=10, nullable=false)
     */
    protected $id;

    /**
     * @var integer $fieldId
     * @ORM\Column(name="`FIELDID`", type="int", length=10, nullable=false)
     */
    protected $fieldId;

    /**
     * @var string $value
     * @ORM\Column(name="`VALUE`", type="string", length=10, nullable=false)
     */
    protected $value;

    /**
     * @var string $context
     * @ORM\Column(name="`CONTEXT`", type="string", length=10, nullable=false)
     */
    protected $context;

    /**
     * @var integer $contextId
     * @ORM\Column(name="`CONTEXTID`", type="int", length=10, nullable=false)
     */
    protected $contextId;

    public function getId () {
        return $this->id;
    }

    public function setId ($id) {
        $this->id = $id;
        return $this;
    }

    public function getContextId () {
        return $this->contextId;
    }

    public function setContextId ($contextId) {
        $this->contextId = $contextId;
        return $this;
    }

    public function getContext () {
        return $this->context;
    }

    public function setContext ($context) {
        $this->contextId = $context;
        return $this;
    }

    public function getValue () {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getFieldId () {
        return $this->fieldId;
    }

    public function setFieldId ($fieldId) {
        $this->fieldId = $fieldId;
        return $this;
    }
}
?>