<?php

namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectFields
 *
 * @ORM\Table(name="`PROJECTFIELDS`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\ProjectFieldsRepository")
 */
class ProjectFields
{
    /**
     * @var integer $project
     * @ORM\Id
     * @ORM\Column(name="`PROJECTID`", type="integer", length=10, nullable=false)
     */
    protected $projectId;

    /**
     * @var integer $field
     * @ORM\Id
     * @ORM\Column(name="`FIELDID`", type="integer", length=10, nullable=false)
     */
    protected $fieldId;

    public function getProjectId () {
        return $this->projectId;
    }

    public function setProjectId ($projectId) {
        $this->projectId = $projectId;
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