<?php

namespace Application\Model\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackerFields
 *
 * @ORM\Table(name="`TRACKERFIELDS`")
 * @ORM\Entity(repositoryClass="Application\Model\Infrastructure\Repositories\ProjectFieldsRepository")
 */
class TrackerFields
{
    /**
     * @var integer $trackerId
     * @ORM\Id
     * @ORM\Column(name="`TRACKERID`", type="integer", length=10, nullable=false)
     */
    protected $trackerId;

    /**
     * @var integer $field
     * @ORM\Id
     * @ORM\Column(name="`FIELDID`", type="integer", length=10, nullable=false)
     */
    protected $fieldId;

    public function getTrackerId () {
        return $this->trackerId;
    }

    public function setTrackerId ($tracker) {
        $this->trackerId = $tracker;
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